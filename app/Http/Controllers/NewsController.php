<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\Car;
use App\News;

class NewsController extends Controller
{
	public function index() {
		//$offers = \App\SpecialOffer::where('is_active', 1)->orderBy('sort')->get();

		$items = News::where('visible', 1);

		/* Фильтр тут */
		if(isset($_REQUEST['date']) && strlen($_REQUEST['date']) > 0)
		{
			$dates = explode('-', $_REQUEST['date']);

			$from = strtotime(trim($dates[0]));
			$to = strtotime(trim($dates[1]));

			$items = $items->where('date', '>', $from);
			$items = $items->where('date', '<', $to);
		}

		if(isset($_REQUEST['key-words']) && strlen($_REQUEST['key-words']) > 0)
		{
			$items = $items->where('text', 'like', '%' . $_REQUEST['key-words'] . '%');
		}


		$items = $items->orderBy('date', 'desc')->paginate(12);

		return view('frontend.news.index', [
			'highlight' => false,
			'news' => $items
		]);
	}

	public function detail($code) {
		$news = \App\News::where('url', $code)->where('visible', 1)->firstOrFail();

		return view('frontend.news.detail', [
			'highlight' => false,
			'item' => $news
		]);
	}
}
