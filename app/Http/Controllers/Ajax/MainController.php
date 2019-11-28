<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function getpcpcompl(Request $request) {
        $carId = (int)$request->get('carid');
        $modId = (int)$request->get('modid');

        $handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/media/downloads/export.csv', 'r');
        $res = '';
        while($row = fgetcsv($handle, 0, ';'))
        {
            if($row[0] == $carId && $row[12] == $modId)
                $res .= '<option value="' . $row[16] . '" data-id="' . $row[17] . '">' . $row[15] . '</option>' . "\n";
        }
        fclose($handle);

        return response($res);
    }

    public function getpcpmod(Request $request) {
        $carId = (int)$request->get('carid');

        $handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/media/downloads/export.csv', 'r');
        $res = '';
        $modList = Array();
        while($row = fgetcsv($handle, 0, ';'))
        {
            if($row[0] == $carId && !in_array($row[12], $modList))
            {
                $res .= '<option value="' . $row[12] . '">' . $row[11] . '</option>' . "\n";
                $modList[] = $row[12];
            }
        }
        fclose($handle);

        return response($res);
    }

    public function sendstart() {
    }

    public function questionsdealers(Request $request) {
        $cross_domain_callback = $request->get('callback');
        $headers = [
            'Content-Type' => 'text/html; charset=utf-8',
        ];
        if($cross_domain_callback) {
            $headers = [
                'Content-Type' => 'text/javascript; charset=utf-8',
            ];
        }

        $list = explode('|', (string)$request->get('city_id'));
        $dealers = \App\Dealer::whereIn('city_id', $list)->orderBy('name')->get();

        $dPos = 0;
        foreach($dealers as $dealer) {
            $ch = substr($dealer->name, 0, 1);
            if(ord($ch) >= ord('А')) {
                break;
            }
            $dPos++;
        }

        $dealers_resorted = $dealers->slice($dPos, $dealers->count())->merge($dealers->slice(0, $dPos));

        $res = '';
        foreach($dealers_resorted as $dealer) {
            if (($dealer->latitude != '' && $dealer->longitude != '') and ($dealer->visible == '1')) {
                $res .= '<li class="drop-down-item" data-value="' . $dealer->name . '">' . $dealer->name .'</li>';
            }
        }

        if($request->get('hide') > 0) {
            $res .= '<li class="drop-down-item" data-value="Приобрел у частного лица / организации">Приобрел у частного лица</li>';
        }

        return response($res)->withHeaders($headers);
    }

    public function checkvin(Request $request) {
        $vin = trim(strtolower($request->get('vin')));

        $handle = fopen($_SERVER['DOCUMENT_ROOT'] . "/media/service/vin.csv", "r");
        $f = true;
        $res = 'N';
        while($row = fgetcsv($handle, 0, ';'))
        {
            if($f)
            {
                $f = false;
                continue;
            }

            if(strtolower($row[1]) == $vin)
            {
                $res = 'Y';
                break;
            }
        }
        fclose($handle);

        return response($res);
    }


}
