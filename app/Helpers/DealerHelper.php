<?php

namespace App\Helpers;

class DealerHelper {
	public static function getCitiesRegions() {
		$result = [];
		$cities = \App\CitiesRegion::orderBy('name')->get();
		$cities_arr = $cities->toArray();
		$cities_list = array();
		$cities_all = array();

		foreach($citiesArr as $city) {
			$cities_all[] = [
				'id' => $city['id'],
				'name' => $city['name'],
				'longitude' => $city['longitude'],
				'latitude' => $city['latitude'],
				'zoom' => $city['zoom'],
			];
		}

		$result['cities_list'] = $cities_arr;
		$result['cities_all_list'] = json_encode($cities_all);

		return $result;
	}
}