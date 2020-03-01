<?php

namespace App\Http\Controllers;

use File;
use Image;
use Validator;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

/***/

	private function getTagString($text, $tag) {
		$posStart = strpos($text, "<{$tag}>") + strlen("<{$tag}>");
		$posEnd = strpos($text, "</{$tag}>", $posStart);
		$data = substr($text, $posStart, $posEnd - $posStart);

		return $data;
	}

	public function getPageData(Request $request) {
		$pagePath = $request->get('page');

		if(!$pagePath) {
			// abort('404');
			return response()->json(['status' => 0], 404);
		}

		/***/
		if(strpos($pagePath, '/i30N') === 0) {
			return response()->json(['status' => 0], 404);
		}
		/***/

		$route = collect(\Route::getRoutes())->first(function($route) use ($pagePath) {
			return $route->matches(request()->create($pagePath));
		});

		if(!$route) {
			// abort('404');
			return response()->json(['status' => 0], 404);
		}

		$routeName = $route->getName();

		if(!preg_match("/^(.*)dealerapi_(.*)$/i", $routeName)) {
			// abort('404');
			return response()->json(['status' => 0], 404);
		}

		$req = Request::create($pagePath, 'GET');
		$res = app()->handle($req);
		$responseBody = $res->getContent();

		$result = [];

		$contentData = $this->getTagString($responseBody, 'content-data');
		// удаление яндекс карт
		// $contentData = preg_replace("/<script src=\"(.+?)(?=\")(.*)><\/script>/i", '', $contentData);
		$contentData = preg_replace("/<script src=\"https:\/\/api-maps.yandex.ru\/(.+?)(?=\")(.*)><\/script>/i", '', $contentData);
		$result['content'] = $contentData;

		$url = env('APP_URL');
		$url = str_replace('http://', '', $url);
		if(strpos($url, 'http') === false)
		    $url = 'https://' . $url;

		$exFiles = $this->layoutFiles();

		preg_match_all("/<link rel=\"stylesheet\" href=\"(.+?)(?=\")/i", $responseBody, $matches);
		$cssArr = [];
		foreach($matches[1] as $match) {
			$m = $match;

			if(strpos($match, '/css/') === 0) {
				$l = strlen($match);
				if(strpos($match, '?') !== false) {
					$l = strpos($match, '?') - strlen('/css/');
				}
				$t = '/dealer/css/' . substr($match, strlen('/css/'), $l);
				if(file_exists(public_path() . $t)) {
					$m = $t;
				}
			}

			if(!in_array($m, $exFiles['css'])) {
				// $cssArr[] = \URL::to('/') . $m;
				$cssArr[] = $url . $m;
			}
		}
		$result['css'] = $cssArr;

		preg_match_all("/<script src=\"(.+?)(?=\")/i", $responseBody, $matches);
		$jsArr = [];
		foreach($matches[1] as $match) {
			$m = $match;

			if(strpos($match, '/js/') === 0) {
				$l = strlen($match);
				if(strpos($match, '?') !== false) {
					$l = strpos($match, '?') - strlen('/js/');
				}
				$t = '/dealer/js/' . substr($match, strlen('/js/'), $l);
				if(file_exists(public_path() . $t)) {
					$m = $t;
				}

				if(!in_array($m, $exFiles['js'])) {
					// $jsArr[] = \URL::to('/') . $m;
					$jsArr[] = $url . $m;
				}
			}
			else {
				// $jsArr[] = $m;
			}
		}
		// $jsArr[] = \URL::to('/') . '/0.js';
		//$jsArr[] = env('APP_URL') . '/0.js';
		if($pagePath != '/ContactUs')
    		$jsArr[] = $url . '/dealer/js/bundles/0.bundle.js';
		$result['js'] = $jsArr;

		// $imgArr = [];
		// preg_match_all("/(\/images\/(.+?)\.(jpg|jpeg|png|svg|gif))/i", $contentData, $matches);
		// foreach($matches[1] as $match) {
		// 	if(!in_array($match, $imgArr)) {
		// 		// $imgArr[] = \URL::to('/') . $match;
		// 		$imgArr[] = env('APP_URL') . $match;
		// 	}
		// }
		// $result['images'] = $imgArr;

		// $assetsArr = [];
		// preg_match_all("/(\/[a-zA-Z0-9\_\-\/]+?\.[a-zA-Z0-9]{3,4})[^a-zA-Z0-9]/i", $contentData, $matches);
		// foreach($matches[1] as $match) {
		// 	if(!in_array($match, $assetsArr) && !in_array($match, $imgArr)) {
		// 		// $assetsArr[] = \URL::to('/') . $match;
		// 		$assetsArr[] = env('APP_URL') . $match;
		// 	}
		// }
		// $result['assets'] = $assetsArr;

		$img_ext_arr = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
		$imgArr = [];
/*
		preg_match_all("/(\/images\/(.+?)\.(jpg|jpeg|png|svg|gif))/i", $contentData, $matches);
		foreach($matches[1] as $match) {
			if(!in_array($match, $imgArr)) {
				//$imgArr[] = \URL::to('/') . $match;
				$imgArr[] = $url . $match;
			}
		}
		$result['images'] = $imgArr;
*/

		$assetsArr = [];
		preg_match_all("/[^\:\/](\/[a-zA-Z0-9\_\-\/а-яА-Я]+?\.[a-zA-Z0-9]{3,4})[^a-zA-Z]/iu", $contentData, $matches);
		foreach($matches[1] as $match) {
/*
			if(!in_array($match, $assetsArr) && !in_array($match, $imgArr)) {
				// $assetsArr[] = \URL::to('/') . $match;
				//$assetsArr[] = env('APP_URL') . $match;
				$assetsArr[] = $url . $match;
*/
			$pathinfo = pathinfo($match);
			if(!in_array($match, $imgArr) && in_array($pathinfo['extension'], $img_ext_arr)) {
				$imgArr[] = $url . $match;
			}
			else if(!in_array($match, $assetsArr)) {
				$assetsArr[] = $url . $match;
			}
		}
		$result['images'] = $imgArr;
		$result['assets'] = $assetsArr;

		$result['status'] = 1;
		return response()->json($result);
	}

	public function getPageDataAll(Request $request) {
		$documentRoot = $_SERVER['DOCUMENT_ROOT'];
		$routeCollection = Route::getRoutes();

		foreach ($routeCollection as $route) {
			$routeUri = $route->uri();
			$routeName = $route->getName();
			if(strpos($routeUri, '{') === false && preg_match("/^(.*)dealerapi_(.*)$/i", $routeName)) {
				$myRequest = new Request();
				$myRequest->request->add(['page' => "/{$routeUri}"]);
				$pageResult = $this->getPageData($myRequest);
				$pageContent = $pageResult->getOriginalContent();
				$lastUpdate = false;
				if($pageContent['status'] == 1) {
					$arrType = ['css', 'js', 'images'];
					foreach($arrType as $type) {
						foreach($pageContent[$type] as $cssfile) {
							$serpath = parse_url($cssfile);
							if(file_exists($documentRoot . $serpath['path'])) {
								$filemtime = filemtime($documentRoot . $serpath['path']);
								if($lastUpdate < $filemtime) {
									$lastUpdate = $filemtime;
								}
							}
						}
					}

					if($filemtime) {
						$dealerPages = \App\DealerMenuPage::where('url', '=', "/{$routeUri}")->get();
						foreach($dealerPages as $dealerPage) {
							$t = strtotime($dealerPage->updated_at);
							if($t < $lastUpdate) {
								$dealerPage->updated_at = date('Y-m-d G:i:s', $lastUpdate);
								$dealerPage->save();
							}
						}
					}
				}
			}
		}

		die();
	}

/***/

	private function layoutFiles() {
		$result = [
			'css' => [
				'/dealer/css/layoutFixed.css',
				'/dealer/css/libs.css',
				'/dealer/css/master.css',
				'/dealer/css/placeholder.css',
			],
			'js' => [
				'/dealer/js/common.js',
				'/dealer/js/lazypreview.js',
				'/dealer/js/libs.js',
			],
		];

		return $result;
	}

	public function getLayoutFiles(Request $request) {
		$result = $this->layoutFiles();
		foreach($result['css'] as &$item) {
			$item = 'https://hyundai.ru' . $item;
		}
		foreach($result['js'] as &$item) {
			$item = 'https://hyundai.ru' . $item;
		}

		return response()->json($result);
	}

	public function getAllImages(Request $request) {
		//$url = env('APP_URL');
		$url = 'https://hyundai.ru';
		$result = [
			'images' => [],
			'preview' => [],
		];
//		$img_ext_arr = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        $img_ext_arr = ['jpg', 'jpeg', 'png'];
		$publicPathStrLen = strlen(public_path());
		$files = \File::allFiles(public_path('images'));
		foreach($files as $file) {
			$filepath = substr($file->getPathname(), $publicPathStrLen);
			if(in_array($file->getExtension(), $img_ext_arr) && !in_array($url . $filepath, $result['images'])) {
				$result['images'][] = $url . $filepath;
				$result['preview'][] = $url . '/getPicThumb' . $filepath . '?h=50&w=50';
			}
		}

		// $files = \File::allFiles(public_path('storage'));
		// foreach($files as $file) {
		// 	if(in_array($file->getExtension(), $img_ext_arr)) {
		// 		$filepath = substr($file->getPathname(), $publicPathStrLen);
		// 		$result['images'][] = $url . $filepath;
		// 		$result['preview'][] = $url . '/getPicThumb' . $filepath . '?h=50&w=50';
		// 	}
		// }

		$banners = \App\Banner::where('visible', '=', 1)->get();
		foreach($banners as $banner) {
			$result['images'][] = $url . $banner->getImageUrl();
			$result['preview'][] = $url . '/getPicThumb' . $banner->getImageUrl() . '?h=50&w=50';
			$result['images'][] = $url . $banner->getImageMobileUrl();
			$result['preview'][] = $url . '/getPicThumb' . $banner->getImageMobileUrl() . '?h=50&w=50';
		}

		$routeCollection = Route::getRoutes();
		foreach ($routeCollection as $route) {
			$routeUri = $route->uri();
			$routeName = $route->getName();
			if(preg_match("/^(.*)dealerapi_(.*)$/i", $routeName)) {
				if(strpos($routeUri, '{') === false) {
					$myRequest = new Request();
					$myRequest->request->add(['page' => "/{$routeUri}"]);
					$pageResult = $this->getPageData($myRequest);
					$pageContent = $pageResult->getOriginalContent();
					if($pageContent['status'] == 1) {
						foreach($pageContent['images'] as $image) {
							if(strpos($image, '/storage/') !== false) {
								$img_path = substr($image, strpos($image, '/storage/'));
								if(file_exists(public_path() . $img_path) && !in_array($url . $img_path, $result['images'])) {
									$result['images'][] = $url . $img_path;
									$result['preview'][] = $url . '/getPicThumb' . $img_path . '?h=50&w=50';
								}
							}
						}
					}
				}
				elseif($routeName == 'dealerapi_specialofferdb') {
					$offers = \App\SpecialOffer::where('is_active', 1)->where(function($query) {
						$query->where('active_from', '<', date('Y-m-d H:i:s'))
							->orWhereNull('active_from');
					})->where(function($query) {
						$query->where('active_to', '>', date('Y-m-d H:i:s'))
							->orWhereNull('active_to');
					})->orderBy('sort')->get();

					foreach($offers as $offer) {
						$myRequest = new Request();
						$myRequest->request->add(['page' => "/promo/" . $offer->url]);
						$pageResult = $this->getPageData($myRequest);
						$pageContent = $pageResult->getOriginalContent();

						if($pageContent['status'] == 1) {
							foreach($pageContent['images'] as $image) {
								if(strpos($image, '/storage/') !== false) {
									$img_path = substr($image, strpos($image, '/storage/'));
									if(file_exists(public_path() . $img_path) && !in_array($url . $img_path, $result['images'])) {
										$result['images'][] = $url . $img_path;
										$result['preview'][] = $url . '/getPicThumb' . $img_path . '?h=50&w=50';
									}
								}
							}
						}
					}
				}
			}
		}

		return response()->json($result);
	}


	public function sendMSRequests() {

        exit;


/*
    	$items = \App\SiebelLog::where('created_at', '>=', '2019-11-20 12:07')->where('type', '=', 'обратная связь')->orderBy('created_at', 'desc')->skip(160)->take(20)->get();


    	$wsdl = public_path() . '/soap/contactus.WSDL';
			$ns = 'http://schemas.xmlsoap.org/ws/2002/07/secext';

			$username = env('U_SOAP_SIEBEL_LOGIN');
			$password = env('U_SOAP_SIEBEL_PASSWORD');

			$local_cert = '/public/soap/_chain-europe-crmnet.pem';
			$context = stream_context_create(array(
				'ssl' => array(
					'verify_peer' => false,
					'allow_self_signed' => true,
					'local_cert' => $local_cert,
				),
			));

			$client = new \SoapClient(
				$wsdl,
				[
					'trace' => true,
					'exceptions' => true,
					'cache_wsdl' => WSDL_CACHE_NONE,
					'stream_context' => $context,
				]
			);

			$wsse_header = new \App\Helpers\WsseAuthHeader($username, $password, $ns);
			$client->__setSoapHeaders(array($wsse_header));

//            var_dump(count($items)); exit;

    	foreach($items as $item)
    	{

        	$data = json_decode($item['data'], 'array');

            $input = $data;

			try {
				$response = $client->ProcessMessage($input);
			}
			catch(\Exception $e) {
				//return response()->json(['status' => 0, 'message' => $e->getMessage()]);
			}

			var_dump(@$response->Payload->Response->LogId);
        }
*/


//    	var_dump(env('APP_URL')); exit;

/*
    	$items = \App\MotorstudioEventRequest::orderBy('created_at', 'desc')->get();


    	foreach($items as $item)
    	{
        	$fields = $item->toArray();

    		$ch = curl_init();
    		curl_setopt($ch,CURLOPT_URL, 'https://old.hyundai.ru/requestnew/sendEventRequest');
    		curl_setopt($ch,CURLOPT_POST, true);
    		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    		$curl_result = curl_exec($ch);
    	}
*/

/*
        $items = \App\MotorstudioEventRequest::where('created_at', '>=', '2019-10-16')->orderBy('created_at', 'desc')->get();
		foreach($items as $item)
    	{
            $to = 'ep@familyagency.ru';
    		$subject = 'Запрос на проведение мероприятия';

    		Mail::to($to)->send(new \App\Mail\EventRequest($subject, $item));
        }
        var_dump('Ok');

        exit;
*/


/*
		$to = 'TAMitina@hyundai.ru';
		$subject = 'Запрос на проведение мероприятия';

		Mail::to($to)->send(new \App\Mail\EventRequest($subject, $item));
*/


/*
		$items = \App\MotorstudioRequest::orderBy('date', 'desc')->get();

		foreach($items as $request)
		{
			if(isset($request->event) && ($request->event->id == 112))
			{
				$rdata = [
					'email' => $request->email,
					//'email' => 'zakfor@gmail.com',
					'event' => $request->event->name,
					'name' => $request->name,
					'surname' => $request->sirname,
					'date_start' => date('d.m.Y', $request->event->date_start),
					'time_start' => date('H:i', $request->event->date_start),
					'date_end' => date('d.m.Y', $request->event->date_end),
				];
				$to = $request->email;
				$subject = 'Регистрация на мероприятие в Hyundai Motorstudio';
				$from = 'webmaster@hyundai.ru';

				Mail::to($to)->send(new \App\Mail\MotorstudioRequestTmp($subject, $rdata));
			}
		}
		echo 'Ok!';
*/
	}
}
