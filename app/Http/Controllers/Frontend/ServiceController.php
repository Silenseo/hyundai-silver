<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Car;
use App\WarrantyCar;

class ServiceController extends Controller
{
	public function warrantyCars() {
		$cars = Car::where('visible', 1)->has('warranties')->orderBy('name')->get();

		return view('frontend.service.warranty', [
			'cars' => $cars,
		]);
	}
}
?>