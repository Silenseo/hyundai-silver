<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\Car;
use App\SpecialOffer;
use App\SpecialOfferLabel;

class SpecialOfferController extends Controller
{
	public function index() {
		$offers = \App\SpecialOffer::where('is_active', 1)->where(function($query) {
			$query->where('active_from', '<', date('Y-m-d H:i:s'))
				->orWhereNull('active_from');
		})->where(function($query) {
			$query->where('active_to', '>', date('Y-m-d H:i:s'))
				->orWhereNull('active_to');
		})->orderBy('sort')->get();

		return view('frontend.offers.index', [
			'offers' => $offers,
			'highlight' => false,
		]);
	}

	public function detail($code) {
		$offer = \App\SpecialOffer::where('url', $code)->where('is_active', 1)->where(function($query) {
			$query->where('active_from', '<', date('Y-m-d H:i:s'))
				->orWhereNull('active_from');
		})->where(function($query) {
			$query->where('active_to', '>', date('Y-m-d H:i:s'))
				->orWhereNull('active_to');
		})->firstOrFail();

		$offer->head_title = strip_tags($offer->name);

		return view('frontend.offers.detail', [
			'offer' => $offer,
			'highlight' => false,
		]);
	}
}
