<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;

class RequestApiController extends Controller
{
	public function getDealers(Request $request) {
		$cross_domain_callback = $request->get('callback');
		if(!$cross_domain_callback) {
			$headers = [
				'Content-Type' => 'text/html; charset=utf-8',
			];
		}
		else {
			$headers = [
				'Content-Type' => 'text/javascript; charset=utf-8',
			];
		}

		$dealers = \Cache::remember('api_dealers', 3600, function() {
            $dealers = \App\Dealer::orderBy('name', 'asc')->get();
            return $dealers;
        });

        $cities = \Cache::remember('api_cities', 3600, function() {
            $cities = \App\CitiesRegion::orderBy('name', 'asc')->get();
            return $cities;
        });


		//$dealers = \App\Dealer::orderBy('name', 'asc')->get();
		$cities = \App\CitiesRegion::orderBy('name', 'asc')->get();
		$cList = $cities->pluck('name', 'id');

		$dPos = 0;
		foreach($dealers as $dealer) {
			$ch = substr($dealer->name, 0, 1);
			if(ord($ch) >= ord('А')) {
				break;
			}
			$dPos++;
		}

		$dealers_resorted = $dealers->slice($dPos, $dealers->count())->merge($dealers->slice(0, $dPos));

		$result = [];
		foreach($dealers_resorted as $dealer) {
			if (($dealer->latitude != '' && $dealer->longitude != '') and ($dealer->visible == '1')) {
				$zyngaya = "7" . $dealer->zyngaya;
				$encodePhone = urlencode("to:" . $zyngaya . ";toHash:" . sha1($zyngaya . ":bBE9VinAtdzXoupG:Zingaya"));

				if(!is_object($dealer->city)) continue;

				$result[] = [
					'id' => $dealer->id,
					'latitude' => $dealer->latitude,
					'longitude' => $dealer->longitude,
					'name' => $dealer->name,
					'address' => $dealer->address,
					'phone' => $dealer->phone,
					'encode_phone' => $encodePhone,
					'email' => $dealer->email,
					'site' => $dealer->site,
					'code' => $dealer->code,
					'city_id' => strval($dealer->city_id),
					'city_name' => $dealer->city->name,
					'special' => strval($dealer->special),
					'rc_code' => $dealer->rc_code,
					'wa' => strval($dealer->wa),
					'rating' => strval($dealer->rating),
					'credit_id' => $dealer->credit_id,
					'i30n' => $dealer->i30n,
					'legal_name' => $dealer->legal_name
				];
			}
		}

        if(!( $request->get('notest') == 1 ))
        {

    		/****/
    		$encodePhone = urlencode("to:71110002223;toHash:" . sha1('71110002223' . ":bBE9VinAtdzXoupG:Zingaya"));
    		$point = array();
    		$point['id'] = 10000;
    		$point['latitude'] = 0;
    		$point['longitude'] = 0;
    		$point['name'] = 'Маркетинг-тест';
    		$point['address'] = 'Москва, ул. Тверская, дом 11';
    		$point['phone'] = '+71110002223';
    		$point['encode_phone'] = $encodePhone;
    		$point['email'] = '';
    		$point['site'] = '';
    		$point['code'] = 'C40AF00MRK';
    		$point['city_id'] = 19;
    		$point['city_name'] = 'Москва';
    		$point['special'] = 0;
    		$point['rc_code'] = '';
    		array_push($result, $point);
    		/****/
        }

		if($request->get('debug') == 'Y') {
			var_dump($result);
			exit;
		}

		if(!$cross_domain_callback) {
			return response($result)->withHeaders($headers);
		}
		else {
			$answ = json_encode($result);
			return response($cross_domain_callback."({'answer':'".$answ." })")->withHeaders($headers);
		}
	}

	public function getModels(Request $request) {
		$modelsCollection = \App\Car::orderBy('menu_row')->orderBy('menu_column')->get();

		$models = Array();

		foreach($modelsCollection as $M) {
			$models[] = Array(
				'id' => $M->id,
				'id_text' => $M->id_text,
				// 'old' => $M->is_shown == 0 ? 1 : 0,
				'name' => $M->name,
				'url' => 'https://' . $_SERVER['HTTP_HOST'] . '/' . $M->id_text,
				'url_mob' => 'http://m.hyundai.ru/' . $M->id_text,
				'min_price' => $M->price_min,
				'image' => 'http://' . $_SERVER['HTTP_HOST'] . '/' . $M->getImageUrl(),
				// 'description' => $M->service_API_field,
				'conf_id' => $M->conf_id,
				'real_conf_id' => $M->conf_id,
				'row' => $M->menu_row,
				'col' => $M->menu_column,
				// 'name_en' => $M->eng_name,
				'img_left_mp' => $M->getImageLeftUrl(),
				'img_right_mp' => $M->getImageRightUrl(),
				'img_beauty_mp' => $M->getImageBeautyUrl(),
				'old' => (int)$M->is_old_model,
				'name_en' => $M->name_menu_en,
				'siebel_name' => $M->siebel_code,
				'description' => '',
			);
		}

		if($request->get('debug') == 'Y') {
			var_dump($models);
			exit;
		}

		return response()->json($models);
	}

	public function getEvents(Request $request) {
	}

	public function getOffers(Request $request) {

	    $offers = \App\SpecialOffer::where('is_active', 1)->where(function($query) {
			$query->where('active_from', '<', date('Y-m-d H:i:s'))
				->orWhereNull('active_from');
		})->where(function($query) {
			$query->where('active_to', '>', date('Y-m-d H:i:s'))
				->orWhereNull('active_to');
		})->orderBy('sort')->get();

		$Result = Array();

		foreach($offers as $Offer)
		{
            //var_dump($offer); exit;

			preg_match_all("#<div class=\"offer-price-count ruble\">(.*?)</div>#is", $Offer->text, $matches);

			$offerText = $Offer->text;
			if(!preg_match("/\<div.*offer\-terms.*\>/i", $Offer->text)) {
				$offerText = '<div class="offer-terms">' . $offerText . '</div>';
			}

			$OfferArray = Array(
				'id' => $Offer->id,
				'name' => $Offer->name,
				'subtitle' => $Offer->banner_subtitle,
				'date_start' => $Offer->active_from,
				'date_end' => $Offer->active_to,
				'img' => 'https://www.hyundai.ru' . $Offer->getImagePreviewUrl(),
				'img_full' => 'https://www.hyundai.ru' . $Offer->getBannerUrl(),
				'img_mobile_app' => 'https://www.hyundai.ru' . $Offer->getBannerMobileUrl(),
				'url' => (strpos($Offer->url, '/') === 0) ? 'https://www.hyundai.ru' . $Offer->url : '',
				'text' => (strpos($Offer->url, '/') === 0) ? '' : $offerText,
				'price' => isset($matches[0][0]) ? intval(str_replace(' ', '', strip_tags($matches[0][0]))) : '',
				'img_preview' => 'https://www.hyundai.ru' . $Offer->getImageWorldUrl(),
				'img_preview_2' => 'https://www.hyundai.ru' . $Offer->getImageWorldUrl()
			);

			$Result[] = $OfferArray;
		}

		if($request->get('debug') == 'Y') {
			var_dump($Result);
			exit;
		}

		return response()->json($Result);
	}

	public function getBrochureCodes(Request $request) {
		$Res = Array(
			11 => 'EQUUS',
			12 => 'Genesis',
			13 => 'i40',
			14 => 'i40',
			15 => 'Elantra',
			16 => 'Veloster',
			17 => 'i30',
			18 => 'i30',
			19 => 'i30',
			20 => 'Solaris',
			21 => 'Solaris',
			22 => 'Grand Santa Fe',
			23 => '',
			24 => 'Santa Fe',
			25 => 'Tucson',
			26 => 'H-1'
		);

		return response()->json($Res);
	}

	public function requestBrochure(Request $request) {
		$post = $request->all();

		$wsdl = "media/soap/WS_CRE_DOUBLE_OPTIN.WSDL";
		$ns = 'http://schemas.xmlsoap.org/ws/2002/07/secext';

		$username = env('U_SOAP_SIEBEL_LOGIN');
		$password = env('U_SOAP_SIEBEL_PASSWORD');

		$client = new \SoapClient(
			$wsdl,
			[
				'trace' => true,
				'exceptions' => true,
				'cache_wsdl' => WSDL_CACHE_NONE,
			]
		);

		$wsse_header = new \App\Helpers\WsseAuthHeader($username, $password, $ns);
		$client->__setSoapHeaders(array($wsse_header));

		$data = [
			"Payload" => [
				"Request" => [
					"Subsidiary"	 => "HMCIS",
					"ExternalSystem" => "HMCIS_WEB",

					"InterfaceCode"	 => "WS_CRE_DOUBLE_OPTIN_LEAD",

					"Customer" => [
						"LastName"				=> $post["last_name"],
						"FirstName"				=> $post["first_name"],
						"EmailAddress"			=> $post["email"],
						"MobilePhone"			=> $post["mobile"],
						"DateofBirth"			=> $post["birthdate"],
						"MarketingAgreement"	=> $post["agree"]
					],

					"Lead"	=> [
						"LeadType"		=> "Brochure Request (PDF)",
						"RequestModel"	=> $post["model"]
					]
				]
			]
		];

		try {
			$response = $client->ProcessMessage($data);
		}
		catch(\Exception $e) {
			return response($e->getMessage());
		}

		$answ =  json_encode($response->Payload->Response);
		return response("{'answer':'".$response->Payload->Response->ResultCode."' , 'answ':".$answ." }");
	}

}
