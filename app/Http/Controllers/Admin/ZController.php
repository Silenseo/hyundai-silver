<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use App\SEO;

class ZController extends Controller
{
	public function test(Request $request) {
		/*
		$db = \DB::connection('mysqlTestConnection');
		$newsOld = $db->table('news')->where('date', '>', '2019-02-04')->get();
		foreach($newsOld as $item) {
			\App\News::create([
				'date' => strtotime($item->date),
				'title' => $item->title,
				'url' => $item->url,
				'text' => $item->text,
				'img' => basename($item->img), //news_image -> news
				// 'comment' => $item->comment,
				'meta_title' => $item->meta_title,
				'meta_keywords' => $item->meta_keywords,
				'meta_description' => $item->meta_description,
				'visible' => $item->visible,
			]);
		}

		$bCatOld = $db->table('brandcollection_categories')->get();
		$catArr = [];
		foreach($bCatOld as $item) {
			$t = \App\BrandcollectionCategory::create([
				'name' => $item->name,
				'sort' => $item->sort,
				'is_active' => $item->is_active,
				'code' => $item->url,
			]);

			$catArr[$item->id] = $t->id;
		}

		$bTagOld = $db->table('brandcollection_tags')->get();
		$tagArr = [];
		foreach($bTagOld as $item) {
			$t = \App\BrandcollectionTag::create([
				'name' => $item->name,
				'sort' => $item->sort,
				'is_active' => $item->is_active,
			]);

			$tagArr[$item->id] = $t->id;
		}

		$bProdOld = $db->table('brandcollection_products')->get();
		foreach($bProdOld as $item) {
			$t = new \App\BrandcollectionProduct();
			$t->name = $item->name;
			$t->article = $item->article;
			$t->category_id = $catArr[$item->category_id];
			$t->tag_id = $tagArr[$item->tag_id];
			$t->price = $item->price;
			$t->image = $item->image; // -> brandcollection_products
			$t->description = $item->description;
			$t->size = $item->size;
			$t->material = $item->material;
			$t->specifications = $item->specifications;
			$t->sort = $item->sort;
			$t->is_active = $item->is_active;
			$t->is_new = $item->is_new;
			$t->save();
		}

		$specOfferLabel = \App\SpecialOfferLabel::create(['name' => '1', 'color' => '000']);
		$offersOld = $db->table('offers')->get();
		foreach($offersOld as $item) {
			$t = new \App\SpecialOffer();
			$t->name = $item->name;
			$t->url = empty($item->title) ? $item->link : $item->title;
			$t->label_id = $specOfferLabel->id;
			$t->text = $item->text;
			$t->image_preview = basename($item->img); //offers_image -> special_offers
			$t->image_world = basename($item->img_preview);
			$t->banner = $item->img_dop;
			$t->banner_title = $t->name;
			$t->banner_subtitle = $t->subtitle;
			$t->blue_show = 0;
			$t->blue_row1_type = 0;
			$t->blue_row2_type = 0;
			$t->blue_row3_type = 0;
			$t->blue_row1_text = '';
			$t->blue_row2_text = '';
			$t->blue_row3_text = '';
			$t->disclaimer = '';
			$t->button_type = 0;
			$t->is_active = $item->visible;
			$t->sort = $item->order;
			$t->active_from = null;
			$t->active_to = null;
			$t->show_quick_buttons = 0;
			$t->type = ($item->is_promo == 1) ? 1 : 0;
			$t->save();
		}

		$bannersOld = $db->table('bannersbig')->get();
		foreach($bannersOld as $item) {
			$t = new \App\Banner();
			$t->name = $item->name;
			$t->title = $item->title;
			$t->subtitle = $item->subtitle;
			$t->image = basename($item->image_prev); //banners_big_image -> banners
			$t->blue_show = $item->blue_show;
			$t->blue_row1 = $item->blue_row1;
			$t->blue_row2 = $item->blue_row2;
			$t->blue_row3 = $item->blue_row3;
			$t->font_color = $item->font_color;
			$t->row1_type = $item->row1_type;
			$t->row2_type = $item->row2_type;
			$t->row3_type = $item->row3_type;
			$t->order = $item->order;
			$t->visible = 1;
			$t->target = $item->target;
			$t->link = $item->link;
			$t->save();
		}
		*/

		/*
		\App\Dealer::truncate();
		\App\CitiesRegion::truncate();

		$jsonDealers = file_get_contents('https://www.hyundai.ru/requestapi/getDealers');
		$dealersOld = json_decode($jsonDealers, true);
		$jsonCities = file_get_contents('http://api.cofigurator.hyundai.ru/dealers');
		$citiesOld = json_decode($jsonCities, true);
		$order = 100;
		$tDealersOld = [];
		foreach($dealersOld as $item) {
			$tDealersOld[$item['id']] = $item;
		}
		foreach($citiesOld as $item) {
			$city = new \App\CitiesRegion();
			$city->name = $item['name'];
			$city->order = $order;
			$city->save();
			$order += 10;

			foreach($item['dealers'] as $dItem) {
				$dealer = $tDealersOld[$dItem['id']];
				$t = new \App\Dealer();
				$t->name = $dealer['name'];
				$t->address = $dealer['address'];
				$t->phone = $dealer['phone'];
				$t->email = $dealer['email'];
				$t->code = $dealer['code'];
				$t->rc_code = $dealer['rc_code'];
				$t->site = $dealer['site'];
				$t->latitude = $dealer['latitude'];
				$t->longitude = $dealer['longitude'];
				$t->visible = 1;
				$t->zyngaya = '';
				$t->city_id = $city->id;
				$t->special = $dealer['special'];
				$t->wa = $dealer['wa'];
				$t->rating = $dealer['rating'];
				$t->prohibition_requests = 0;
				$t->credit_id = $dealer['credit_id'];
				$t->i30n = $dealer['i30n'];
				$t->save();
			}
		}
		*/

/***/
		$db = \DB::connection('mysqlTestConnection');

		// $carsOld = $db->table('car_models')->get();
		// foreach($carsOld as $item) {
		// 	$t = new \App\Car();
		// 	$t->id_text = $item->id_text;
		// 	$t->name = $item->name;
		// 	$t->ga_modelcode = $item->ga_modelcode;
		// 	$t->is_promo = 1;
		// 	$t->visible = 1;
		// 	$t->save();
		// }

		$accCatArr = [];
		$accCatOld = $db->table('accessories_category')->get();
		foreach($accCatOld as $item) {
			$t = new \App\AccessoriesCategory();
			$t->name = $item->name;
			$t->subtitle = $item->subtitle;
			$t->image = $item->image;
			$t->order = $item->order;
			$t->visible = $item->visible;
			$t->save();
			$accCatArr[$item->id] = $t->id;
		}

		$carModelsOldArr = [];
		$carModelsOld = $db->table('car_models')->get();
		foreach($carModelsOld as $item) {
			$carModelsOldArr[$item->id_text] = $item->id;
		}

		$carModelsArr = [];
		$carModels = \App\Car::all();
		foreach($carModels as $item) {
			if(isset($carModelsOldArr[$item->id_text])) {
				$carModelsArr[$carModelsOldArr[$item->id_text]] = $item->id;
			}
		}

		$accProdArr = [];
		$accProdOld = $db->table('accessories_products')->get();
		foreach($accProdOld as $item) {
			if(isset($accCatArr[$item->category_id])) {
				$t = new \App\AccessoriesProduct();
				$t->category_id = $accCatArr[$item->category_id];
				$t->name = $item->name;
				$t->article = $item->article;
				$t->price = $item->price;
				$t->image = $item->image;
				$t->specs = $item->specs;
				$t->description = $item->description;
				$t->order = $item->order;
				$t->visible = $item->visible;
				$t->save();

				$itemCars = (array)json_decode($item->car_prices, true);
				$carsSyncArr = [];
				if(count($itemCars) > 0) {
					foreach($itemCars as $carId => $carPrice) {
						if(isset($carModelsArr[$carId])) {
							$carsSyncArr[$carModelsArr[$carId]] = ['price' => $carPrice];
						}
					}
				}
				$t->cars()->sync($carsSyncArr);

				$accProdArr[$item->id] = $t->id;
			}
		}

		$accPhotoOld = $db->table('accessories_photos')->get();
		foreach($accPhotoOld as $item) {
			if(isset($accProdArr[$item->product_id])) {
				$t = new \App\AccessoriesPhoto();
				$t->product_id = $accProdArr[$item->product_id];
				$t->image = $item->image;
				$t->save();
			}
		}

		$msEventsOld = $db->table('motorstudio_events')->get();
		foreach($msEventsOld as $item) {
			$t = new \App\MotorstudioEvent();
			$t->name = $item->name;
			$t->name_en = $item->name_en;
			$t->calendar_name = $item->calendar_name;
			$t->calendar_name_en = $item->calendar_name_en;
			$t->date_start = $item->date_start;
			$t->date_end = $item->date_end;
			$t->preview_picture = $item->preview_picture;
			$t->detail_picture = $item->detail_picture;
			$t->text = $item->text;
			$t->text_en = $item->text_en;
			$t->max_reg = $item->max_reg;
			$t->is_promo = $item->is_promo;
			$t->available = $item->available;
			$t->repair = $item->repair;
			$t->visible = $item->visible;
			$t->save();
		}

	}
}
