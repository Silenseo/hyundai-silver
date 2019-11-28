<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Offer;

class OffersController extends Controller
{
	public function allOffers() {
		$items = Offer::orderBy('is_promo')->orderBy('order')->get();
	}

	public function offerPage($code) {
		$item = Offer::where('code', $code)->first();

		if(!$item) {
			abort(404);
		}

		$offers = Offer::where('visible', '>', '0')->get();
		$offersList = Array();
		foreach($offers as $offer) {
			$mlist = explode('|', $offer->models);
			if(in_array($item->id, $mlist))
				$offersList[] = $offer;
		}
	}

	public function offerPageRedirect($code) {
		return redirect('/all-offers/' . $code);
	}

	public function specialOffer() {
		$handle = fopen($_SERVER['DOCUMENT_ROOT'] . "/media/service/tradein.csv", "r");

		$cars = [];
		while ($row = fgetcsv($handle, 0, ';')) {
			if ($row[0] == "CarCode") {
				continue;
			}

			$cars[] = [
				"name" => $row[0]
				, "tradein" => $row[1]
				, "programm" => $row[2]
				, "points" => $row[3]
				, "id" => $row[4]
			];
		}
		krsort($cars);
		fclose($handle);
	}

	public function pl2() {
		// return view();
	}

	public function blogOffers($title) {
		$item = Offer::where('title', $title)->where('visible', '>', 0)->first();

		if(!$item) {
			abort(404);
		}
	}

}
