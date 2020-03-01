<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');

        $news = \Cache::remember('home_index_news', 3600, function () {
            $news = \App\News::where('visible', 1)->orderBy('date', 'desc')->limit(12)->get();
            return $news;
        });
        $banners = \Cache::remember('home_index_banners1', 3600, function () {
            $banners = \App\Banner::where('visible', 1)->orderBy('order')->get();
            return $banners;
        });

        $key = 'json_config4';

        if (!Cache::has($key)) {
            $configSON = file_get_contents('http://configurator.hyundai.ru/exportdata/main/');

            Cache::put($key, $configSON, 3600);
        } else {
            $configSON = Cache::get($key);
        }

        $arConfig = json_decode($configSON);
        foreach ($arConfig as $key => $car) {
            if ($car->name == 'i30 N')
                break;
        }
        unset($arConfig[$key]);
        foreach ($arConfig as $rr)
        {
            $new[] = (array)$rr;
        }
        return view('index', [
            'news_items' => $news,
            'banners' => $banners,
            'configJSON' => json_encode($new)
        ]);
    }

    public function indexDealer()
    {
        // return view('home');
        $banners = \Cache::remember('home_index_banners', 3600, function() {
            $banners = \App\Banner::where('visible', 1)->orderBy('order')->get();
            return $banners;
        });

        return view('index-dealer', [
			'banners' => $banners,
			'highlight' => false
        ]);
    }

    public function admintest()
    {
        return view('admin-test');
    }
}
