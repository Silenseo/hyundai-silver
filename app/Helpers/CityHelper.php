<?php

namespace App\Helpers;

use App\CitiesRegion;
use App\Dealer;

class CityHelper {
	public static function getCitiesList() {
		$cities = CitiesRegion::all()->pluck('name', 'id');

		return $cities;
	}

	public static function getCitiesDealers($city_id = 0) {
		$city = CitiesRegion::find($city_id);

		$dealers = null;
		if($city) {
			$dealers = $city->dealers_sorted;
		}

		return $dealers;
	}

	public static function getCitiesDealersAll() {
		$cities = CitiesRegion::all();

		$cities->each->append('dealers_sorted');

		return $cities;
	}
}
