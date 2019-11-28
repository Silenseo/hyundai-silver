<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Placeholder;

class PlaceholderHelper {
	public static function getPlaceholderData($id, $width = 0, $height = 0) {
		$result = '';
		$placeholder = Placeholder::where('code', $id)->first();
		if(!$placeholder) {
			return $result;
		}

		$storage = Storage::disk('public');
		if($storage->exists($placeholder->image)) {
			$img = Image::make($storage->get($placeholder->image));
			if($width > 0 && $height > 0) {
				$img->resize($width, $height);
			}

			return $img->response();
		}
		else {
    		if(strlen($placeholder->image) > 0)
    		    return '/storage/placeholders/' . $placeholder->image;
            else
			    return $placeholder->text;
		}
	}
}
