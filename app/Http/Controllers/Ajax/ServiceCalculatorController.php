<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Helpers\PlaceholderHelper;

class ServiceCalculatorController extends Controller
{
    protected function getFileName()
    {
        $defaultPath = $_SERVER['DOCUMENT_ROOT'] . "/media/service/service_new.csv";

        $file = PlaceholderHelper::getPlaceholderData('service');

        if(strlen($file) > 0)
            $defaultPath = str_replace('/storage', '../storage/app/public', $file);

        return $defaultPath;
    }


    public function getServiceJSON(Request $request) {

        $out = [];

        $path = $this->getFileName();
        $handle = fopen($path, "r");


        $CarArray = array();

        $f = true;

        while($row = fgetcsv($handle, 0, ';'))
        {

	        if($f)
	        {
		        $f = false;
		        continue;
	        }

            $code = str_replace(' ', '', strtolower($row[3]));

            if($code == '') continue;

            if(!isset($CarArray[$code]))
            	$CarArray[$code] = array(
	            	'name' => $row[3],
	            	'engines' => Array()
            	);

			// Сначала чекаем тип движка


            if(!isset($CarArray[$code]['engines'][$row[5]]))
            	$CarArray[$code]['engines'][$row[5]] = Array();

            if(!in_array($row[4], $CarArray[$code]['engines'][$row[5]]))
            	$CarArray[$code]['engines'][$row[5]][] = $row[4];
        }

        // Надо перепилить CarArray

        $tmp = Array();

        foreach($CarArray as $CarCode => $CarData)
        {
	        if($CarCode == 'sonata') continue;

	        $CarData['code'] = $CarCode;
	        $CarData['image'] = '/service/cars/car-image--' . $CarCode . '.png';

	        $tmp[] = $CarData;

	        if($CarCode == 'elantranew')
	        {
		        // После нее надо поставить Сонату

		        $addCar = $CarArray['sonata'];
		    	$addCar['code'] = 'sonata';
				$addCar['image'] = '/service/cars/car-image--' . 'sonata' . '.png';

				$tmp[] = $addCar;
	        }


        }

        $CarArray = $tmp;



        return response()->json($CarArray);
    }

    public function getServiceDealers(Request $request) {
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
        foreach ($dealers_resorted as $dealer) {
            if (($dealer->latitude != '' && $dealer->longitude != '') and ($dealer->visible == '1')) {
                $res .= '<li class="drop-down-item" data-value="' . $dealer->code . '">' . $dealer->name .'</li>';
            }
        };

        return response($res)->withHeaders($headers);
    }

    public function getServiceEngines(Request $request) {
        $carCode = strtolower($request->get('car'));
        if($carCode == 'h-1') $carCode = 'h1';

        $path = $this->getFileName();
        $handle = fopen($path, "r");

//        $handle = fopen($_SERVER['DOCUMENT_ROOT'] . "/media/service/service_new.csv", "r");

        /*
        Коды полей:
        [0]=> string(19) "Код дилера"
        [1]=> string(27) "Код SAP площадки"
        [2]=> string(20) "Контрагент"
        [3]=> string(12) "Модель"
        [4]=> string(25) "Рабочий объем"
        [5]=> string(25) "Тип двигателя"
        [6]=> string(19) "Работы 1 год 15000 км - гарантийный"
        [7]=> string(21) "Работы 2 года 30000 км - гарантийный"
        [8]=> string(21) "Работы 3 года 45000 км - гарантийный"
        [9]=> string(21) "Работы 4 года 60000 км - гарантийный"
        [10]=> string(19) "Работы 5 лет 75000 км - гарантийный"
        [11]=> string(28) "Работы 6 лет 90000 км АКПП - гарантийный"
        [12]=> string(19) "Запчасти 1 год 15000 км - гарантийный"
        [13]=> string(21) "Запчасти 2 года 30000 км - гарантийный"
        [14]=> string(21) "Запчасти 3 года 45000 км - гарантийный"
        [15]=> string(21) "Запчасти 4 года 60000 км - гарантийный"
        [16]=> string(19) "Запчасти 5 лет 75000 км - гарантийный"
        [17]=> string(28) "Запчасти 6 лет 90000 км АКПП - гарантийный"
        [18]=> string(19) "Работы 1 год 15000 км - негарантийный"
        [19]=> string(21) "Работы 2 года 30000 км - негарантийный"
        [20]=> string(21) "Работы 3 года 45000 км - негарантийный"
        [21]=> string(21) "Работы 4 года 60000 км - негарантийный"
        [22]=> string(19) "Работы 5 лет 75000 км - негарантийный"
        [23]=> string(28) "Работы 6 лет 90000 км АКПП - негарантийный"
        [24]=> string(19) "Запчасти 1 год 15000 км - негарантийный"
        [25]=> string(21) "Запчасти 2 года 30000 км - негарантийный"
        [26]=> string(21) "Запчасти 3 года 45000 км - негарантийный"
        [27]=> string(21) "Запчасти 4 года 60000 км - негарантийный"
        [28]=> string(19) "Запчасти 5 лет 75000 км - негарантийный"
        [29]=> string(28) "Запчасти 6 лет 90000 км АКПП - негарантийный"
        [30]=> string(19) "Итого 1 год 15000 км - гарантийный"
        [31]=> string(21) "Итого 2 года 30000 км - гарантийный"
        [32]=> string(21) "Итого 3 года 45000 км - гарантийный"
        [33]=> string(21) "Итого 4 года 60000 км - гарантийный"
        [34]=> string(19) "Итого 5 лет 75000 км - гарантийный"
        [35]=> string(28) "Итого 6 лет 90000 км АКПП - гарантийный"
        [36]=> string(19) "Итого 1 год 15000 км - негарантийный"
        [37]=> string(21) "Итого 2 года 30000 км - негарантийный"
        [38]=> string(21) "Итого 3 года 45000 км - негарантийный"
        [39]=> string(21) "Итого 4 года 60000 км - негарантийный"
        [40]=> string(19) "Итого 5 лет 75000 км - негарантийный"
        [41]=> string(28) "Итого 6 лет 90000 км АКПП - негарантийный"
        */

        $engineList = Array();

        $f = true;
        while($row = fgetcsv($handle, 0, ';'))
        {
            if(strtolower($row[3]) == $carCode)
            {
                if(!in_array($row[4], $engineList))
                    $engineList[] = $row[4];
            }
        }
        fclose($handle);

        $res['count'] = count($engineList);
        $res['data'] = '';
        if(count($engineList) > 0)
        {
            foreach($engineList as $engine)
                $res['data'] .= '<li class="engine-control-item" data-value="' . $engine . '">' . $engine . '</li>' . "\n";
        }

        return response()->json($res);
    }

    public function getServiceEngineTypes()
    {
        $carCode = strtolower($request->get('car'));
        if($carCode == 'h-1') $carCode = 'h1';
        $engine = $request->get('engine');

        //$handle = fopen($_SERVER['DOCUMENT_ROOT'] . "/media/service/service_new.csv", "r");

        $path = $this->getFileName();
        $handle = fopen($path, "r");

        /*
        Коды полей:
        [0]=> string(19) "Код дилера"
        [1]=> string(27) "Код SAP площадки"
        [2]=> string(20) "Контрагент"
        [3]=> string(12) "Модель"
        [4]=> string(25) "Рабочий объем"
        [5]=> string(25) "Тип двигателя"
        [6]=> string(19) "Работы 1 год 15000 км - гарантийный"
        [7]=> string(21) "Работы 2 года 30000 км - гарантийный"
        [8]=> string(21) "Работы 3 года 45000 км - гарантийный"
        [9]=> string(21) "Работы 4 года 60000 км - гарантийный"
        [10]=> string(19) "Работы 5 лет 75000 км - гарантийный"
        [11]=> string(28) "Работы 6 лет 90000 км АКПП - гарантийный"
        [12]=> string(19) "Запчасти 1 год 15000 км - гарантийный"
        [13]=> string(21) "Запчасти 2 года 30000 км - гарантийный"
        [14]=> string(21) "Запчасти 3 года 45000 км - гарантийный"
        [15]=> string(21) "Запчасти 4 года 60000 км - гарантийный"
        [16]=> string(19) "Запчасти 5 лет 75000 км - гарантийный"
        [17]=> string(28) "Запчасти 6 лет 90000 км АКПП - гарантийный"
        [18]=> string(19) "Работы 1 год 15000 км - негарантийный"
        [19]=> string(21) "Работы 2 года 30000 км - негарантийный"
        [20]=> string(21) "Работы 3 года 45000 км - негарантийный"
        [21]=> string(21) "Работы 4 года 60000 км - негарантийный"
        [22]=> string(19) "Работы 5 лет 75000 км - негарантийный"
        [23]=> string(28) "Работы 6 лет 90000 км АКПП - негарантийный"
        [24]=> string(19) "Запчасти 1 год 15000 км - негарантийный"
        [25]=> string(21) "Запчасти 2 года 30000 км - негарантийный"
        [26]=> string(21) "Запчасти 3 года 45000 км - негарантийный"
        [27]=> string(21) "Запчасти 4 года 60000 км - негарантийный"
        [28]=> string(19) "Запчасти 5 лет 75000 км - негарантийный"
        [29]=> string(28) "Запчасти 6 лет 90000 км АКПП - негарантийный"
        [30]=> string(19) "Итого 1 год 15000 км - гарантийный"
        [31]=> string(21) "Итого 2 года 30000 км - гарантийный"
        [32]=> string(21) "Итого 3 года 45000 км - гарантийный"
        [33]=> string(21) "Итого 4 года 60000 км - гарантийный"
        [34]=> string(19) "Итого 5 лет 75000 км - гарантийный"
        [35]=> string(28) "Итого 6 лет 90000 км АКПП - гарантийный"
        [36]=> string(19) "Итого 1 год 15000 км - негарантийный"
        [37]=> string(21) "Итого 2 года 30000 км - негарантийный"
        [38]=> string(21) "Итого 3 года 45000 км - негарантийный"
        [39]=> string(21) "Итого 4 года 60000 км - негарантийный"
        [40]=> string(19) "Итого 5 лет 75000 км - негарантийный"
        [41]=> string(28) "Итого 6 лет 90000 км АКПП - негарантийный"
        */

        $engineTypeList = Array();

        $f = true;
        while($row = fgetcsv($handle, 0, ';'))
        {
            if(strtolower($row[3]) == $carCode && $row[4] == $engine)
            {
                if(!in_array($row[5], $engineTypeList))
                    $engineTypeList[] = $row[5];
            }
        }
        fclose($handle);

        $res['count'] = count($engineTypeList);
        $res['data'] = '';
        if(count($engineTypeList) > 0)
        {
            foreach($engineTypeList as $engineType)
                $res['data'] .= '<li class="engine-control-item" data-value="' . $engineType . '">' . $engineType . '</li>' . "\n";
        }

        return response()->json($res);
    }

    public function getServiceCost(Request $request) {
        $carCode = strtolower($request->get('car'));
        if($carCode == 'h-1') $carCode = 'h1';
        $engine = $request->get('engine');
        $enginetype = $request->get('enginetype');
        $dealer = $request->get('dealer');
        $mileage = $request->get('mileage');
        $autotype = 1;
        $sparesOut = $request->get('spares');

        $pricesIds = $autotype=="1"
            ? self::__getPricesIds($mileage, 0, $sparesOut)
            : self::__getPricesIds($mileage, 9, $sparesOut);

        //$handle = fopen($_SERVER['DOCUMENT_ROOT'] . "/media/service/service_new.csv", "r");

        $path = $this->getFileName();
        $handle = fopen($path, "r");

        /*
        Коды полей:
        [0]=> string(19) "Код дилера"
        [1]=> string(27) "Код SAP площадки"
        [2]=> string(20) "Сервисный код дилера"
        [3]=> string(20) "Контрагент"
        [4]=> string(12) "Модель"
        [5]=> string(25) "Рабочий объем"
        [6]=> string(25) "Тип двигателя"
        [7]=> string(19) "Работы 1 год 15000 км - гарантийный"
        [8]=> string(21) "Работы 2 года 30000 км - гарантийный"
        [9]=> string(21) "Работы 3 года 45000 км - гарантийный"
        [10]=> string(21) "Работы 4 года 60000 км - гарантийный"
        [11]=> string(19) "Работы 5 лет 75000 км - гарантийный"
        [12]=> string(28) "Работы 6 лет 90000 км АКПП - гарантийный"
        [13]=> string(19) "Запчасти 1 год 15000 км - гарантийный"
        [14]=> string(21) "Запчасти 2 года 30000 км - гарантийный"
        [15]=> string(21) "Запчасти 3 года 45000 км - гарантийный"
        [16]=> string(21) "Запчасти 4 года 60000 км - гарантийный"
        [17]=> string(19) "Запчасти 5 лет 75000 км - гарантийный"
        [18]=> string(28) "Запчасти 6 лет 90000 км АКПП - гарантийный"
        [19]=> string(21) "Запчасти PL2 4 года 60000 км - гарантийный"
        [20]=> string(19) "Запчасти PL2 5 лет 75000 км - гарантийный"
        [21]=> string(28) "Запчасти PL2 6 лет 90000 км АКПП - гарантийный"
        [22]=> string(19) "Работы 1 год 15000 км - негарантийный"
        [23]=> string(21) "Работы 2 года 30000 км - негарантийный"
        [24]=> string(21) "Работы 3 года 45000 км - негарантийный"
        [25]=> string(21) "Работы 4 года 60000 км - негарантийный"
        [26]=> string(19) "Работы 5 лет 75000 км - негарантийный"
        [27]=> string(28) "Работы 6 лет 90000 км АКПП - негарантийный"
        [28]=> string(19) "Запчасти 1 год 15000 км - негарантийный"
        [29]=> string(21) "Запчасти 2 года 30000 км - негарантийный"
        [30]=> string(21) "Запчасти 3 года 45000 км - негарантийный"
        [31]=> string(21) "Запчасти 4 года 60000 км - негарантийный"
        [32]=> string(19) "Запчасти 5 лет 75000 км - негарантийный"
        [33]=> string(28) "Запчасти 6 лет 90000 км АКПП - негарантийный"

        [34]=> string(21) "Запчасти PL2 4 года 60000 км - негарантийный"
        [35]=> string(19) "Запчасти PL2 5 лет 75000 км - негарантийный"
        [36]=> string(28) "Запчасти PL2 6 лет 90000 км АКПП - негарантийный"

        [37]=> string(19) "Итого 1 год 15000 км - гарантийный"
        [38]=> string(21) "Итого 2 года 30000 км - гарантийный"
        [39]=> string(21) "Итого 3 года 45000 км - гарантийный"
        [40]=> string(21) "Итого 4 года 60000 км - гарантийный"
        [41]=> string(19) "Итого 5 лет 75000 км - гарантийный"
        [42]=> string(28) "Итого 6 лет 90000 км АКПП - гарантийный"

        [43]=> string(21) "Итого 4 года 60000 км - гарантийный"
        [44]=> string(19) "Итого 5 лет 75000 км - гарантийный"
        [45]=> string(28) "Итого 6 лет 90000 км АКПП - гарантийный"

        [46]=> string(19) "Итого 1 год 15000 км - негарантийный"
        [47]=> string(21) "Итого 2 года 30000 км - негарантийный"
        [48]=> string(21) "Итого 3 года 45000 км - негарантийный"
        [49]=> string(21) "Итого 4 года 60000 км - негарантийный"
        [50]=> string(19) "Итого 5 лет 75000 км - негарантийный"
        [51]=> string(28) "Итого 6 лет 90000 км АКПП - негарантийный"

        [52]=> string(21) "Итого LP2 4 года 60000 км - негарантийный"
        [53]=> string(19) "Итого LP2 5 лет 75000 км - негарантийный"
        [54]=> string(28) "Итого LP2 6 лет 90000 км АКПП - негарантийный"
        */

        $total = $repairs = $originspares = $pl2spares = 0;

        $f = true;
        while($row = fgetcsv($handle, 0, ';'))
        {
            if(strtolower(str_replace(' ', '', $row[3])) == $carCode && $row[4] == $engine && $row[5] == $enginetype && $row[0] == $dealer)
            {
                $r = $row;
                $repairs = round($row[$pricesIds["repairs"]]);
                $originspares = round($row[$pricesIds["originspares"]]);
                $total = round($row[$pricesIds["total"]]);

                if($total == '' || $total == 0)
                {
                    $total = $originspares + $repairs;
                }

                $pl2spares = $pricesIds["pl2spares"] ? round($row[$pricesIds["pl2spares"]]) : null;

                break;
            }
        }
        fclose($handle);

        $out = [];
        if($total > 0) {
            if($sparesOut == 1)
                $total = $repairs + $pl2spares;
            $out["total"] = $total ? number_format($total, 0, '', ' ') . ' &#8381;' : null;
            $out["repairs"] = number_format($repairs, 0, '', ' ') . ' &#8381;';
            $out["originspares"] = number_format($originspares, 0, '', ' ') . ' &#8381;';
            $out["pl2spares"] = $pl2spares ? number_format($pl2spares, 0, '', ' ') . ' &#8381;' : null;

            $out["total_nf"] = $total ? $total : null;
            $out["repairs_nf"] = $repairs;
            $out["originspares_nf"] = $originspares;
            $out["pl2spares_nf"] = $pl2spares ? $pl2spares : null;
        } else {
            $out  = 0;
        }

        return response()->json($out);
    }

    private static function __getPricesIds($mileage, $offset=0, $spares)
    {
        $simpleOffset = $offset ? 15 : 0;
        switch($mileage)
        {
            case 15: {
                $pricesIds = [
                    "repairs" => 6 + $simpleOffset
                    , "originspares" => 12 + $simpleOffset
                    , "pl2spares" => null
                    , "total" => 21 + $offset
                ];
                break;
            }
            case 30: {
                $pricesIds = [
                    "repairs" => 7 + $simpleOffset
                    , "originspares" => 13 + $simpleOffset
                    , "pl2spares" => null
                    , "total" => 22 + $offset
                ];
                break;
            }
            case 45: {
                $pricesIds = [
                    "repairs" => 8 + $simpleOffset
                    , "originspares" => 14 + $simpleOffset
                    , "pl2spares" => null
                    , "total" => 23 + $offset
                ];
                break;
            }
            case 60: {
                $pricesIds = [
                    "repairs" => 9 + $simpleOffset
                    , "originspares" => 15 + $simpleOffset
                    , "pl2spares" => 18 + $simpleOffset
                    , "total" => 24 + (!$spares ? $offset : 3 + $offset)
                ];
                break;
            }
            case 75: {
                $pricesIds = [
                    "repairs" => 10 + $simpleOffset
                    , "originspares" => 16 + $simpleOffset
                    , "pl2spares" => 19 + $simpleOffset
                    , "total" => 25 + (!$spares ? $offset : 3 + $offset)
                ];
                break;
            }
            case 90: {
                $pricesIds = [
                    "repairs" => 11 + $simpleOffset
                    , "originspares" => 17 + $simpleOffset
                    , "pl2spares" => 20 + $simpleOffset
                    , "total" => 26 + (!$spares ? $offset : 3 + $offset)
                ];
                break;
            }
            default: {
                $pricesIds = [
                    "repairs" => 6 + $simpleOffset
                    , "originspares" => 12 + $simpleOffset
                    , "pl2spares" => null
                    , "total" => 21 + $offset
                ];
            }
        }

        return $pricesIds;
    }
}
