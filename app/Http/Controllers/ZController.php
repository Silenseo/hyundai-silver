<?php

namespace App\Http\Controllers;

use File;
use Image;
use Validator;
use App\Http\Controllers;
use Illuminate\Http\Request;

class ZController extends Controller
{
	public function getPicThumb($path, Request $request) {

		$validator = Validator::make($request->all(), [
			'h' => 'required|numeric',
			'w' => 'required|numeric'
		]);

		if($validator->fails()) {
			abort('404');
		}

		$imgExts = ['jpeg', 'jpg', 'png', 'gif'];
		$path = public_path() . '/' . $path;
		$pathInfo = pathinfo($path);
		$width = $request->get('w') ?: null;
		$height = $request->get('h') ?: null;
		if(!File::exists($path) || !in_array($pathInfo['extension'], $imgExts) || (!$width && !$height)) {
			abort('404');
		}

		$img = Image::cache(function($image) use ($path, $width, $height) {
			return $image->make($path)->resize($width, $height, function ($constraint) use ($width, $height) {
				if(!$width || !$height) {
					$constraint->aspectRatio();
				}
			});
		}, 10, true);

		return $img->response();
	}
}
