<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Dealer;

class CitiesRegion extends Model
{
	protected $fillable = ['id', 'longitude', 'latitude', 'zoom', 'order', 'name', 'name_en', 'name_fi', 'name_de'];

	public function dealers() {
		return $this->hasMany(Dealer::class, 'city_id');
	}

	public function getDealersSortedAttribute() {
		$dealers = $this->dealers()->where('visible', 1)->orderBy('name')->get();

		$dPos = 0;
		foreach($dealers as $dealer) {
			$ch = substr($dealer->name, 0, 1);
			if(ord($ch) >= ord('А')) {
				break;
			}
			$dPos++;
		}

		$dealers_resorted = $dealers->slice($dPos, $dealers->count())->merge($dealers->slice(0, $dPos));

		return $dealers_resorted;
	}

	public function scopeNearestCity($query, $ip) {
		//Москва
		/*$longitude = 55.75167; //долгота
		$latitude = 37.61778; //широта*/
		$latitude = 37.61778;//55.75167;
		$longitude = 55.75167;//37.61778

		try{
			$gi = geoip_open(DOCROOT.'geo/GeoIPCity.dat',GEOIP_STANDARD);
			$record = geoip_record_by_addr($gi, $ip);
			//$longitude = $record->longitude;
			//$latitude = $record->latitude;
			$longitude = $record->latitude;
			$latitude = $record->longitude;
			geoip_close($gi);
		}catch (\Exception $e) {
		}

		$distance_list = array();
		$cities = CitiesRegion::all();
		$distance_min = PHP_INT_MAX;
		$city_res = false;
		foreach($cities as $city) {
			$dX = $longitude - $city->longitude;
			$dY = $latitude - $city->latitude;
			$distance = $dX * $dX + $dY * $dY;
			if($distance_min > $distance) {
				$city_res = $city;
				$distance_min = $distance;
			}
		}

		if(!$city_res) {
			$city_res = CitiesRegion::first();
		}

		return $city_res;
	}
}
