<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\BrandcollectionCategory;
use App\BrandcollectionProduct;
use App\Car;
use App\Manual;
use App\News;
use App\SpecialOffer;
use App\StaticSearch;
use App\WarrantyCar;

class SearchController extends Controller
{
	private static function getTagString($text, $tag) {
		$posStart = strpos($text, "<{$tag}>") + strlen("<{$tag}>");
		$posEnd = strpos($text, "</{$tag}>", $posStart);
		$data = substr($text, $posStart, $posEnd - $posStart);

		return $data;
	}

	public static function searchReindex() {
		$routeCollection = Route::getRoutes();

		foreach ($routeCollection as $route) {
			if(preg_match("/^static_(.*)$/i", $route->getName())) {
				$url = '/' . $route->uri();
				$req = Request::create($url, 'GET');
				$res = app()->handle($req);
				$responseBody = $res->getContent();
				// $posStart = strpos($responseBody, '<content-data>') + strlen('<content-data>');
				// $posEnd = strpos($responseBody, '</content-data>', $posStart);
				// $htmlData = substr($responseBody, $posStart, $posEnd - $posStart);
				$htmlData = self::getTagString($responseBody, 'content-data');
				$textData = html_entity_decode(trim(preg_replace('/\s+/', ' ', strip_tags($htmlData))));
				$titleData = self::getTagString($responseBody, 'title');
				$titleData = html_entity_decode(trim(preg_replace('/\s+/', ' ', strip_tags($titleData))));

				if(strlen($textData) > 0) {
					$item = StaticSearch::firstOrNew(['url' => $url]);
					$item->text = $textData;
					$item->title = $titleData;
					$item->save();
				}
			}
		}
	}

	public function search(Request $request) {
		$searchResults = [];
		$searchString = trim($request->get('q'));

		$result = [
			'message' => '',
			'items' => [],
		];

		if(strlen($searchString) > 3) {
			$items = StaticSearch::simpleSearch($searchString)->get();
			foreach($items as $item) {
				$searchResults[] = [
					'type' => 'Страницы',
					'title' => $item->title, //   <-----
					'text' => $item->text,
					'url' => $item->url,
					'img' => $item->img,
				];
			}

			$items = Car::simpleSearch($searchString)->where('visible', 1)->get();
			foreach($items as $item) {
				$searchResults[] = [
					'type' => 'Автомобили',
					'title' => $item->name,
					'text' => $item->name,
					// 'url' => route('car', ['id_text' => $item->id_text], false),
					'url' => '/' . $item->id_text,
					'img' => $item->getImageUrl(),
				];
			}

			$items = SpecialOffer::simpleSearch($searchString)->where('is_active', 1)->get();
			foreach($items as $item) {
				$searchResults[] = [
					'type' => 'Специальные предложения',
					'title' => $item->name,
					'text' => $item->text,
					'url' => route('offers.detail', ['code' => $item->url], false),
					'img' => $item->getImagePreviewUrl(),
				];
			}

			$items = News::simpleSearch($searchString)->where('visible', 1)->get();
			foreach($items as $item) {
				$searchResults[] = [
					'type' => 'Новости',
					'title' => $item->title,
					'text' => $item->text,
					'url' => route('news.detail', ['code' => $item->url], false),
					'img' => $item->getImgPathAttribute(),
					'date' => $item->datePublic,
				];
			}

			$items = WarrantyCar::simpleSearch($searchString)->where('is_active', 1)->get();
			foreach($items as $item) {
				$searchResults[] = [
					'type' => 'Гарантии',
					'title' => $item->name,
					'text' => $item->description,
					'url' => route('service.warranty', [], false),
					'img' => '',
				];
			}

			$items = Manual::simpleSearch($searchString)->where('is_active', 1)->get();
			foreach($items as $item) {
				$searchResults[] = [
					'type' => 'Руководства',
					'title' => $item->name,
					'text' => $item->name,
					'url' => route('service.manuals', [], false),
					'img' => '',
				];
			}

			$items = BrandcollectionCategory::simpleSearch($searchString)->where('is_active', 1)->get();
			foreach($items as $item) {
				$searchResults[] = [
					'type' => 'Бренд-коллекция',
					'title' => $item->name,
					'text' => $item->name,
					'url' => route('brandcollection.detail', ['code' => $item->code], false),
					'img' => '',
				];
			}

			$items = BrandcollectionProduct::simpleSearch($searchString)->where('is_active', 1)->get();
			foreach($items as $item) {
				$searchResults[] = [
					'type' => 'Бренд-коллекция',
					'title' => $item->name,
					'text' => $item->description,
					'url' => route('brandcollection.detail', ['code' => $item->category->code], false) . '#id=' . $item->id,
					'img' => $item->getImageUrl(),
				];
			}
		}
		else {
			$$result['message'] = 'Запрос слишком короткий';
		}

		$result['items'] = $searchResults;

		return $result;
	}

	public function searchAsJson(Request $request) {
		$result = $this->search($request);

		return response()->json($result);
	}

	public function searchAsPage(Request $request) {
		$result = $this->search($request);

		return view('frontend.pages.search', ['header' => true, 'highlight' => false, 'footer' => true, 'searchResults' => $result['items'], 'searchQuery' => $request->get('q'), 'searchMessage' => $result['message']]);
	}
}