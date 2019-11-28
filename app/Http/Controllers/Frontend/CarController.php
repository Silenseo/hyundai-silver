<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Car;
use App\Helpers\PlaceholderHelper;

class CarController extends Controller
{
	public function showCar($id_text) {
		$car = Car::where('id_text', $id_text)->where('is_old_model', 0)->first();

		if(!$car) {
			abort(404);
		}

		// return response()->view('cars.' . $id_text);
		return response($car);
	}

	public function NewSantaFe() {

    	$disclaimer = PlaceholderHelper::getPlaceholderData('NewSantaFe_start');

    	return view('frontend.cars.santaFe.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
	}

	public function Elantra() {

		$disclaimer = PlaceholderHelper::getPlaceholderData('Elantra_start');

		return view('frontend.cars.elantra.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
	}

	public function Tucson() {

		$disclaimer = PlaceholderHelper::getPlaceholderData('Tucson_start');

		return view('frontend.cars.tucson.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
	}

	public function i30n() {

		$disclaimer = PlaceholderHelper::getPlaceholderData('i30n_start');

		return view('frontend.cars.i30n.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
	}

	public function Solaris() {

    	$disclaimer = PlaceholderHelper::getPlaceholderData('Solaris_start');

    	return view('frontend.cars.solaris.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
	}

	public function Sonata() {

    	$disclaimer = PlaceholderHelper::getPlaceholderData('Sonata_start');

    	return view('frontend.cars.sonata.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
	}

	public function NewSonata() {

		$disclaimer = PlaceholderHelper::getPlaceholderData('NewSonata_start');

		return view('frontend.cars.sonataNew.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
}

	public function Creta() {

    	$disclaimer = PlaceholderHelper::getPlaceholderData('Creta_start');

    	return view('frontend.cars.creta.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
	}

	public function H1() {

    	$disclaimer = PlaceholderHelper::getPlaceholderData('H-1_start');

    	return view('frontend.cars.h1.index', ['header' => true, 'highlight' => true, 'footer' => true, 'disclaimer' => $disclaimer]);
	}
}
