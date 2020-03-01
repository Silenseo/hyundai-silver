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

class ApiController extends \App\Http\Controllers\Controller
{
	public function carList(Request $request) {
		$items = Car::where('visible', 1);
		if($request->get('with_old') != 1) {
			$items = $items->where('is_old_model', 0);
		}
		$items = $items->orderBy('name')->get();

		$cars = [];
		foreach($items as $item) {
			$cars[] = [
				'id' => $item->id,
				'name' => $item->name,
				'code' => $item->siebel_code,
				'image' => $item->getImageUrl(),
				'link' => $item->url,
			];
		}

		if($request->get('oldCars') == 1) {

    		$oldCarsHardcodeArray = [
        		'Accent' => 'Accent',
        		'Coupe' => 'Coupe',
        		'Equus' => 'EQUUS',
        		'Genesis' => 'Genesis',
        		'Genesis Coupe' => 'Genesis Coupe',
        		'Getz' => 'Getz',
        		'Grandeur' => 'Grandeur',
        		'i20' => 'i20',
        		'i30' => 'i30',
        		'i40' => 'i40',
        		'ix35' => 'ix35',
        		'ix55' => 'ix55',
        		'Matrix' => 'Matrix',
        		'Grand Santa Fe' => 'Grand SANTA FE',
        		'Sonata' => 'NF/SONATA',
        		'Terracan' => 'Terracan',
        		'Trajet' => 'Trajet',
        		'Veloster' => 'Veloster',
        		'Verna' => 'Verna/Accent',
        		'Other' => 'Другая модель'
    		];

    		foreach($oldCarsHardcodeArray as $code=>$name)
    		{
        		$cars[] = [
    				'id' => 0,
    				'name' => $name,
    				'code' => $code,
    				'image' => '',
    				'link' => '',
    			];
    		}
        }

		return response()->json($cars);
	}

	public function dealers(Request $request) {
		// $cities = CitiesRegion::with(['dealers' => function($q){
		// 	$q->where('dealers.visible', '=', 1);
		// }])->get();
		$cities = CitiesRegion::orderBy('order')->get();

		$resArr = [];
		foreach($cities as $city) {
			$d = [];
			foreach($city->dealers_sorted as $dealer) {
				$d[] = [
					'id' => $dealer->id,
					'name' => $dealer->name,
					'code' => $dealer->code,
					'latitude' => $dealer->latitude,
					'longitude' => $dealer->longitude,
					'address' => $dealer->address,
					'phone' => $dealer->phone,
					'email' => $dealer->email,
					'legal_name' => $dealer->legal_name,
					'legal_address' => $dealer->legal_address
				];
			}

			$resArr[] = [
				'name' => $city->name,
				'dealers' => $d,
			];
		}

		return response()->json($resArr);
	}
}
