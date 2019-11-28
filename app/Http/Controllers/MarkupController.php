<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;

class MarkupController extends Controller
{
	public function getView($name) {
		return response()->view('markup.' . $name);
	}
}