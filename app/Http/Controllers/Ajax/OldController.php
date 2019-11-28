<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

use App\Car;
use App\CitiesRegion;
use App\Dealer;
use App\Jobseeker;
use App\MotorstudioRequest;
use App\SiebelLog;


use App\Helpers\PlaceholderHelper;

class OldController extends \App\Http\Controllers\Controller
{

/*
    protected function getFileName()
    {
        $defaultPath = $_SERVER['DOCUMENT_ROOT'] . "/media/service/service_new.csv";

        $file = PlaceholderHelper::getPlaceholderData('service');

        if(strlen($file) > 0)
            $defaultPath = str_replace('/storage', '../storage/app/public', $file);

        return $defaultPath;
    }
*/

    public function checkVin(Request $request) {
		$vin = $request->get('vin');
		$result = 0;
		if(($handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/media/service/vin.csv', 'r')) !== FALSE) {
			while(($data = fgetcsv($handle, 1000)) !== FALSE) {
				$num = count($data);
				for($i = 0; $i < $num; $i++) {
					if($data[$i] == $vin) {
						$result = 1;
						break;
					}
				}
			}
			fclose($handle);
		}

        if($result == 1)
            echo 'Y';
        else
            echo 'N';
        exit;
//		return response()->json(['status' => $result]);
	}

}
