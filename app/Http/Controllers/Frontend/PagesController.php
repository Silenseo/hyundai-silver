<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Helpers\PlaceholderHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function start($carCode = '') {
        $key = 'disclaimer_start4';

        if(!Cache::has($key))
        {
            $disclaimer['NewSantaFe_start'] = PlaceholderHelper::getPlaceholderData('NewSantaFe_start');
            $disclaimer['NewElantra_start'] = PlaceholderHelper::getPlaceholderData('NewElantra_start');
            $disclaimer['NewTucson_start'] = PlaceholderHelper::getPlaceholderData('NewTucson_start');
            $disclaimer['i30n_start'] = PlaceholderHelper::getPlaceholderData('i30n_start');
            $disclaimer['Solaris_start'] = PlaceholderHelper::getPlaceholderData('Solaris_start');
            $disclaimer['Sonata_start'] = PlaceholderHelper::getPlaceholderData('Sonata_start');
            $disclaimer['NewSonata_start'] = PlaceholderHelper::getPlaceholderData('NewSonata_start');
            $disclaimer['Creta_start'] = PlaceholderHelper::getPlaceholderData('Creta_start');
            $disclaimer['H-1_start'] = PlaceholderHelper::getPlaceholderData('H-1_start');

            $disclaimer['NewSantaFe_startplus'] = PlaceholderHelper::getPlaceholderData('NewSantaFe_startplus');
            $disclaimer['NewElantra_startplus'] = PlaceholderHelper::getPlaceholderData('NewElantra_startplus');
            $disclaimer['NewTucson_startplus'] = PlaceholderHelper::getPlaceholderData('NewTucson_startplus');
            $disclaimer['i30n_startplus'] = PlaceholderHelper::getPlaceholderData('i30n_startplus');
            $disclaimer['Solaris_startplus'] = PlaceholderHelper::getPlaceholderData('Solaris_startplus');
            $disclaimer['Sonata_startplus'] = PlaceholderHelper::getPlaceholderData('Sonata_startplus');
            $disclaimer['Creta_startplus'] = PlaceholderHelper::getPlaceholderData('Creta_startplus');
            $disclaimer['H-1_startplus'] = PlaceholderHelper::getPlaceholderData('H-1_startplus');

            Cache::put($key, $disclaimer, 3600);
        }
        else
        {
            $disclaimer = Cache::get($key);
        }

        return view('frontend.start.index', ['header' => true, 'highlight' => false, 'footer' => true, 'disclaimer' => $disclaimer, 'code' => $carCode]);
	}
}
?>
