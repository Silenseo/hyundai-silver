<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\MotorstudioEvent;
use App\MotorstudioDeadline;
use App\MotorstudioRequest;

use Crawler;

class MotorstudioController extends Controller
{
    public function __construct() {}

    public function getMotorstudioJSON() {
        $subs = MotorstudioRequest::orderBy('date', 'desc')->get();
        $subsArray = Array();

        foreach($subs as $s)
        {
            if(!isset($subsArray[$s->event_id]))
                $subsArray[$s->event_id] = 0;

            $subsArray[$s->event_id]++;
        }

        $items = MotorstudioEvent::where('visible', 1)->orderBy('date_start')->get();

        $json = Array();
        $promo = Array();

        foreach($items as $item)
        {
            if(isset($subsArray[$item->id]) && $item->max_reg <= $subsArray[$item->id] && $item->max_reg > 0)
                $item->available = 0;

            if($item->date_end < time())
                $item->available = 0;

            if(strlen($item->calendar_name ) == 0)
            {
                $item->calendar_name = substr($item->name, 0, 80);

                if(strlen($item->name) > 80)
                {
                    $tmp = explode(' ', $item->calendar_name);

                    $cnt = count($tmp);
                    if(strlen($tmp[$cnt-1]) > 0)
                    {
                        unset($tmp[$cnt-1]);
                    }

                    $item->calendar_name = implode(' ', $tmp) . '...';
                }
            }

            $json[] = Array(
                'id' => $item->id,
                'name' => $item->name,
                'calendar_name' => $item->calendar_name,
                'description' => $item->text,
                'from' => date('Y-m-d', $item->date_start),
                'to' => date('Y-m-d', $item->date_end),
                'img' => $item->getPreviewPictureUrl(),
                'img_mobile' => strlen($item->getMobilePictureUrl()) > 0 ? $item->getMobilePictureUrl() : $item->getPreviewPictureUrl(),
                'available' => ($item->available == 1),
                'repair' => ($item->repair == 1),
                'promo' => ($item->is_promo == 1),
                'promo_img' => $item->getDetailPictureUrl(),
                'altLong' => date('H', $item->date_end) == 0 && $item->date_end < $item->date_start
            );
        }

        // Логика для попапа закрытия

        $popupData = [
            'open' => 0,
            'text' => ''
        ];

        $deadlines = MotorstudioDeadline::orderBy('closed_from')->get();

        foreach($deadlines as $dl)
        {
            if(strtotime($dl->show_from) <= time() and strtotime($dl->show_to) >= time())
            {
                $popupData = [
                    'open' => 1,
                    'text' => $dl->reason
                ];

                break;
            }
        }


        // Костыль для первого попапа
        if($popupData['open'] == 0 && time() <= mktime(23, 0, 0, 7, 31, 2019))
        {
            $popupData = [
                'open' => 1,
                'text' => 'HYUNDAI MOTORSTUDIO Москва работает 31 июля до 16.00 в связи с подготовкой к мероприятию'
            ];
        }



        if(Crawler::isCrawler())
        {
            return view('frontend.motorstudio.seo', [
                'items' => $json,
                'promo' => $promo,
                'popupData' => $popupData
            ]);
        }
        else
        {
            $json = json_encode($json);
            $promo = json_encode($promo);
            $popupData = json_encode($popupData);

            return view('frontend.motorstudio.index', [
                'items' => $json,
                'promo' => $promo,
                'popupData' => $popupData
            ]);
        }
	}

    public function getMotorstudioEnJSON() {
        $subs = MotorstudioRequest::orderBy('date', 'desc')->get();
        $subsArray = Array();

        foreach($subs as $s)
        {
            if(!isset($subsArray[$s->event_id]))
                $subsArray[$s->event_id] = 0;

            $subsArray[$s->event_id]++;
        }

        $items = MotorstudioEvent::where('visible', 1)->orderBy('date_start')->get();

        $json = Array();
        $promo = Array();

        foreach($items as $item)
        {
            if(isset($subsArray[$item->id]) && $item->max_reg <= $subsArray[$item->id] && $item->max_reg > 0)
                $item->available = 0;

            if($item->date_end < time())
                $item->available = 0;

            if(strlen($item->calendar_name ) == 0)
            {
                $item->calendar_name = substr($item->name, 0, 80);

                if(strlen($item->name) > 80)
                {
                    $tmp = explode(' ', $item->calendar_name);

                    $cnt = count($tmp);
                    if(strlen($tmp[$cnt-1]) > 0)
                    {
                        unset($tmp[$cnt-1]);
                    }

                    $item->calendar_name = implode(' ', $tmp) . '...';
                }
            }

            $json[] = Array(
                'id' => $item->id,
                'name' => $item->name,
                'calendar_name' => $item->calendar_name,
                'description' => $item->text,
                'from' => date('Y-m-d', $item->date_start),
                'to' => date('Y-m-d', $item->date_end),
                'img' => $item->getPreviewPictureUrl(),
                'available' => ($item->available == 1),
                'repair' => ($item->repair == 1),
                'promo' => ($item->is_promo == 1),
                'promo_img' => $item->getDetailPictureUrl(),
                'altLong' => date('H', $item->date_end) == 0 && $item->date_end < $item->date_start
            );
        }

        $json = json_encode($json);
        $promo = json_encode($promo);

        return view('frontend.motorstudio.en', [
            'items' => $json,
            'promo' => $promo,
        ]);
    }

    public function sendEventSubscribe(Request $request) {
        $result = Array('status' => 0);

        $item = new MotorstudioRequest;
        $list = MotorstudioRequest::where('event_id', $request->get('id'))->get();
        $cntCurrent = $list->count();

        $event = MotorstudioEvent::find($request->get('id'));
        $cntMax = $event->max_reg;

        if($cntCurrent < $cntMax || $cntMax == 0)
        {
            $item->event_id = $request->get('id');
            $item->date = time();
            $item->name = (string)$request->get('name');
            $item->sirname = (string)$request->get('surname');
            $item->email = (string)$request->get('email');
            $item->phone = (string)$request->get('tel');
            $item->age = (string)$request->get('age');

            if($item->save())
            {
                $result = Array('status' => 1);

/*
                $config = Kohana::$config->load('email');
                Email::connect($config);

                $to = $_REQUEST['email'];
                $subject = 'Регистрация на мероприятие в Hyundai Motorstudio';
                $from = 'registration.motorstudio@hyundai.ru';
                //$message = $ReEmail;


                $data = $_REQUEST;

                $message = View::factory('mail/motorstudio', array(
                    'event' => $event->name,
                    'name' => $_REQUEST['name'],
                    'surname' => $_REQUEST['surname'],
                    'date_start' => date('d.m.Y', $event->date_start),
                    'time_start' => date('H:i', $event->date_start),
                    'date_end' => date('d.m.Y', $event->date_end),
                ))->render();

                //var_dump($message); exit;


                //Email::send($to, $from, $subject, $message, $html = true);
                mail($to, $subject, $message,
                    "Content-type: text/html; charset=utf-8\r\nFrom: " . $from);
*/
            }
        }
        else
        {
            $result = Array('status' => 2);
        }

        return response()->json($result);
    }

}
