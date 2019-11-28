<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\SiebelLog;

class SoapSiebelController extends Controller
{
	public function sendcrm(Request $request) {
		$cross_domain_callback = $request->get('callback');
		$headers = [
			'Content-Type' => 'text/html; charset=utf-8',
		];
		if($cross_domain_callback) {
			$headers = [
				'Content-Type' => 'text/javascript; charset=utf-8',
			];
		}

		$username = env('U_SOAP_SIEBEL_LOGIN');
		$password = env('U_SOAP_SIEBEL_PASSWORD');

		$wsdl = 'public/soap/crm.wsdl';
		$ns = 'http://schemas.xmlsoap.org/ws/2002/07/secext';

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

		$campaignCode = (string)$request->get('code');
		if($campaignCode == '') {
			$campaignCode = (string)$request->get('campaignCode') == "true" ? "HMCIS0000183" : "";// 1 "HMCIS0000183" // 2 "HMCIS0000385"
		}

		$model = trim($request->get('model'));

		if(strpos($model, 'Solaris') !== false)
			$model = 'Solaris New';

		if(strpos($model, 'Sonata') !== false)
			$model = 'Sonata';

		$model = str_replace('Santa fe', 'Santa Fe', $model);

		switch($model)
		{
			case 'SOLARIS' : { $model = 'Solaris'; break; }
			case 'Grand SANTA FE' : { $model = 'Grand Santa Fe'; break; }
			case 'SONATA' : { $model == 'Sonata'; break; }
			case 'SANTA FE' : { $model = 'Santa Fe'; break; }
			case 'ELANTRA' : { $model = 'Elantra'; break; }
			case 'TUCSON' : { $model = 'Tucson'; break; }
			case 'CRETA' : { $model = 'Creta'; break; }
			case 'Новый SANTA FE' : { $model = 'New Santa Fe 2018'; break; }
			case 'NEW TUCSON' : { $model = 'New Tucson 2018'; break; }
			case 'Новый TUCSON' : { $model = 'New Tucson 2018'; break; }
			case 'New Tucson' : { $model = 'New Tucson 2018'; break; }
		}

		if(strpos($model, 'SONATA') !== false)
			$model = str_replace('SONATA', 'Sonata', $model);

		if(strpos($model, 'New Santa') !== false)
			$model = 'New Santa Fe 2018';

		$dealerCode = $request->get('dealer');

		$time = time();
		$timeLast = mktime(23,59,59, 04, 30, 2018);

		if($dealerCode == 'C40AF20041' && $time <= $timeLast)
			$dealerCode = 'C40AF00233';

		$description = 'Marketing request from homepage';

		if($campaignCode == 'HMCIS0005321')
			$description = 'MIAS-2018 Mindwave activation';

		if($request->get('from_url'))
			$description .= ' Sended From: ' . $request->get('from_url');

		$input = [
			'Payload' => [
				'Request' => [
					'Lead' => [
						'CampaignCode' => $campaignCode,
						'LeadType' => 'Test Drive Request',
						'DealerCode' => $dealerCode,
						'Description' => $description,
						'IntendedReplacementPeriod' => '',
						'RequestTime' => '',
						'RequestDate' => date('Ymd'),
						'RequestModel' => $model,
					],
					'Customer' => [
						'FirstName' => $request->get('name'),
						'LastName' => $request->get('surname'),
						'City' => $request->get('city'),
						'Region' => 'no set',
						'Country' => 'Russia',
						'DateofBirth' => '',
						'EmailAddress' => trim((string)$request->get('email')),
						'Gender' => 'F',
						'HomePhone' => $request->get('phone'),
						'MarketingAgreement' => 'Y',
						'MobilePhone' => $request->get('phone'),
						'PreferredContactChannel' => 'Email',
						'StreetAddress1' => 'no set',
						'StreetAddress2' => 'no set',
						'StreetAddress3' => 'no set',
						'PostCode' => 'no set',
						'Salutation' => $request->get('salutation'),
					],
					'InterfaceCode' => 'WS_CRE_LEAD',
					'Subsidiary' => 'HMCIS',
					'ExternalSystem' => 'HMCIS_WEB',
				]
			]
		];

		try {
			$response = $client->ProcessMessage($input);
			// var_dump($response);
		}
		catch(\Exception $e) {
			return response($e->getMessage())->withHeaders($headers);
		}

		if($request->get('googleId'))
			\App\Helpers\MirHelper::sendContact($request->get('googleId'), $request->get('yandexId'), $request->get('email'), $request->get('phone'));

		$siebel_log = SiebelLog::create([
			'source' => (string)$request->get('source'),
			'type' => 'тест-драйв',
			'logId' => $response->Payload->Response->LogId,
			'data' => json_encode($input),
		]);

		$this->sendMirTD($request);

		if(!$cross_domain_callback) {
			return response($response->Payload->Response->ResultCode)->withHeaders($headers);
		}
		else {
			$answ = json_encode($response->Payload->Response);
			return response($cross_domain_callback."({'answer':'".$response->Payload->Response->ResultCode."' , 'answ':".$answ." })")->withHeaders($headers);
		}
	}

	public function sendServiceRequestToCRM(Request $request) {
		$cross_domain_callback = $request->get('callback');
		$headers = [
			'Content-Type' => 'text/html; charset=utf-8',
		];
		if($cross_domain_callback) {
			$headers = [
				'Content-Type' => 'text/javascript; charset=utf-8',
			];
		}

		$description = '';
		$gender = ($request->get('salutation') == 'Mr.') ? 'M' : 'F';
		$model_engine_type = $request->get('model_engine_type') ?: 'не указано';
		$model_mileage = $request->get('model_mileage') ?: 'не указано';
		$model_vin = $request->get('model_vin') ?: 'не указано';
		$comment = $request->get('comment') ?: 'не указано';

		$description .= 'Год выпуска: ' . $request->get('model_year') . '<br>';
		$description .= 'Тип заявки: ' . $model_engine_type . '<br>';
		$description .= 'Пробег автомобиля: ' . $model_mileage . '<br>';
		$description .= 'Комментарий: ' . $comment . ';';

		$username = env('U_SOAP_SIEBEL_LOGIN');
		$password = env('U_SOAP_SIEBEL_PASSWORD');

		$wsdl = 'public/soap/WS_CRE_LEAD_V.1.6_REQUEST.WSDL';
		$ns = 'http://schemas.xmlsoap.org/ws/2002/07/secext';

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

		$model = trim($request->get('model'));

		switch($model)
		{
			case 'solarisnew': { $model = 'Solaris New'; break;}
			case 'solaris': { $model = 'Solaris'; break;}
			case 'elantra': { $model = 'Elantra'; break;}
			case 'elantranew': { $model = 'Elantra'; break;}
			case 'sonata': { $model = 'Sonata'; break;}
			case 'veloster': { $model = 'Veloster'; break;}
			case 'creta': { $model = 'Creta'; break;}
			case 'tucson': { $model = 'Tucson'; break;}
			case 'santafe': { $model = 'Santa Fe'; break;}
			case 'grandsantafe': { $model = 'Grand Santa Fe'; break;}
			case 'h1': { $model = 'H-1'; break;}
		}

		if(strpos($model, 'Solaris') !== false)
			$model = 'Solaris New';

		if(strpos($model, 'Sonata') !== false)
			$model = 'Sonata';

		if(strpos($model, 'Sonata') !== false)
			$model = 'Sonata';

		$model = str_replace('Santa fe', 'Santa Fe', $model);

		switch($model)
		{
			case 'SOLARIS' : { $model = 'Solaris'; break; }
			case 'Grand SANTA FE' : { $model = 'Grand Santa Fe'; break; }
			case 'SANTA FE' : { $model = 'Santa Fe'; break; }
			case 'ELANTRA' : { $model = 'Elantra'; break; }
			case 'TUCSON' : { $model = 'Tucson'; break; }
			case 'CRETA' : { $model = 'Creta'; break; }
		}

		if(strpos($model, 'SONATA') !== false)
			str_replace('SONATA', 'Sonata', $model);

		$campaignCode = (string)$request->get('code');
		if($campaignCode == '') {
			$campaignCode = (string)$request->get('campaignCode') == "true" ? "HMCIS0000183" : "";// 1 "HMCIS0000183" // 2 "HMCIS0000385"
		}

		$input = [
			'Payload' => [
				'Request' => [
					'Lead' => [
						'CampaignCode' => $campaignCode,
						'LeadType' => 'Technical Maintenance Request',
						'ServiceType' => $request->get('model_engine_type'),
						'DealerCode' => $request->get('dealer'),
						'Description' => $description,
						'IntendedReplacementPeriod' => '',
						'RequestTime' => '',
						'RequestDate' => date('Ymd'),
						'RequestModel' => $model,
					],
					'Customer' => [
						'FirstName' => $request->get('name'),
						'LastName' => $request->get('surname'),
						'City' => $request->get('city'),
						'Region' => 'no set',
						'Country' => 'Russia',
						'DateofBirth' => '',
						'EmailAddress' => trim((string)$request->get('email')),
						'Gender' => $gender,
						'HomePhone' => $request->get('phone'),
						'MarketingAgreement' => 'Y',
						'MobilePhone' => $request->get('phone'),
						'PreferredContactChannel' => 'Email',
						'StreetAddress1' => 'no set',
						'StreetAddress2' => 'no set',
						'StreetAddress3' => 'no set',
						'PostCode' => 'no set',
						'Salutation' => $request->get('salutation'),
					],
					'InterfaceCode' => 'WS_CRE_LEAD',
					'Subsidiary' => 'HMCIS',
					'ExternalSystem' => 'HMCIS_WEB',
				]
			]
		];

		try {
			$response = $client->ProcessMessage($input);
		}
		catch(\Exception $e) {
			return response($e->getMessage())->withHeaders($headers);
		}

		$siebel_log = SiebelLog::create([
			'source' => (string)$request->get('source'),
			'type' => 'заявка на ТО',
			'logId' => $response->Payload->Response->LogId,
			'data' => json_encode($input),
		]);

		// if ($response->Payload->Response->ResultCode == 'Y')
		// {
		// 	//$Msg = New Msg();

		// 	$config = Kohana::$config->load('email');
		// 	Email::connect($config);

		// 	$to = $post['email'];
		// 	$subject = 'Hyundai. Запись на ТО';
		// 	$from = 'webmaster@hyundai.ru';


		// 	$data = $_REQUEST;

		// 	$message = View::factory('mail/servicerequest', array(
		// 		'data' => $post
		// 	))->render();

		// 	//var_dump($message); exit;


		// 	//Email::send($to, $from, $subject, $message, $html = true);
		// 	mail($to, $subject, $message,
		// 		"Content-type: text/html; charset=utf-8\r\nFrom: " . $from);

		// }

		$this->sendMirTO($request);

		if(!$cross_domain_callback) {
			return response($response->Payload->Response->ResultCode)->withHeaders($headers);
		}
		else {
			$answ = json_encode($response->Payload->Response);
			return response($cross_domain_callback."({'answer':'".$response->Payload->Response->ResultCode."' , 'answ':".$answ." })")->withHeaders($headers);
		}
	}

	public function sendcontactus(Request $request) {
		// if(!$request->ajax()) {
		// 	die();
		// }

		if($request->get('human') != 'Y') {
			return response()->json(['status' => 0]);
		}

		$post = $request->all();

		$isMir = false;
		if($post['theme'] == 'Mir') {
			$post['theme'] == 'Мир Хёндэ';
			$isMir = true;
		}

		$strToHash = [];
		$strToHash[] = $post['name'];
		$strToHash[] = $post['surname'];
		$strToHash[] = $post['middleName'];
		$strToHash[] = $post['city'];
		$strToHash[] = $post['cityDealer'];
		$strToHash[] = $post['dealer'];
		$strToHash[] = $post['phone'];
		$strToHash[] = $post['email'];
		$strToHash[] = $post['theme'];
		$strToHash[] = $post['msg'];
		$strToHash[] = $post['model'];

		$strToHash[] = isset($post['vin']) ? $post['vin'] : 'undefined';

		$strToHash[] = $post['status'];
		$strToHash[] = isset($post['organizaton']) ? $post['organizaton'] : 'undefined';
		// $strToHash[] = $post['wish'];
		$strToHash[] = isset($post['date_buy']) ? $post['date_buy'] : 'undefined';
		$strToHash[] = isset($post['date_request']) ? $post['date_request'] : 'undefined';
		$strToHash[] = isset($post['dealer_solve']) ? $post['dealer_solve'] : 'undefined';

		$strToHash = implode('|', $strToHash);

		$hash = strlen(iconv('UTF-8', 'WINDOWS-1251', $strToHash));

		// if(!isset($post['hash'])) {
		// 	return response('N');
		// }

		// if(abs($hash - $post['hash']) > 2) {
		// 	return response('N');
		// }

        $to = env('DEALER_EMAIL');
        $subject = 'Запрос из формы обратной связи';
        $from = 'webmaster@hyundai.ru';

        Mail::to($to)->send(new \App\Mail\ContactUs($subject, $post));

        $success = 'Y';

		if ( $success == 'Y' && !isset($post['no_mail'])) {

    		//$url = 'https://old.hyundai.ru/requestnew/sendcontactusmail?' . http_build_query($_REQUEST);

/*
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec ($ch);
            $err = curl_error($ch);  //if you need
            curl_close ($ch);
*/

/*
            $to = $post['email'];
            $subject = 'Ваш запрос отправлен';
            $from = 'webmaster@hyundai.ru';

            Mail::to($to)->send(new \App\Mail\ContactUs($subject, $post));
*/

			// $config = Kohana::$config->load('email');
			// Email::connect($config);

			// $to = $post['email'];
			// $subject = 'Ваш запрос отправлен';
			// $from = 'webmaster@hyundai.ru';
			// //$message = $ReEmail;


			// $data = $_REQUEST;

			// $message = View::factory('mail/contactus', array(
			// 	'data' => $post
			// ))->render();

			// //var_dump($message); exit;


			// //Email::send($to, $from, $subject, $message, $html = true);
			// mail($to, $subject, $message,
			// 	"Content-type: text/html; charset=utf-8\r\nFrom: " . $from);

			// if($isMir)
			// {
			// 	$subject = 'Новое сообщение из формы обратной связи';
			// 	mail('mir@hyundai.ru', $subject, $message,
			// 	"Content-type: text/html; charset=utf-8\r\nFrom: " . $from);


			// 	$logname = 'send_contactus_' . date('Y_m_d') . '.log';

			// 	$f = fopen($_SERVER['DOCUMENT_ROOT'] . '/crm_log/' . $logname, 'a+');
			// 	fwrite($f, date('d.m.Y H:i:s') . "\n");
			// 	fwrite($f, 'theme: ' . $post['theme'] . "\n");
			// 	fwrite($f, json_encode($post) . "\n");
			// 	fwrite($f, "MAIL SEND\n");
			// 	fwrite($f, "--------\n");
			// 	fclose($f);
			// }
		}

		$result = $success == 'Y' ? 1 : 0;

		return response()->json(['status' => $result]);
	}

	public function requestBrochure(Request $request) {
		if(!$request->ajax()) {
			die();
		}

		$wsdl = "public/soap/WS_CRE_DOUBLE_OPTIN.WSDL";
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

		$input = [
			'Payload' => [
				'Request' => [
					'Lead' => [
						'LeadType' => 'Brochure Request (PDF)',
						'RequestModel' => $request->get('model'),
					],
					'Customer' => [
						'FirstName' => $request->get('first_name'),
						'LastName' => $request->get('last_name'),
						'DateofBirth' => $request->get('birthdate'),
						'EmailAddress' => $request->get('email'),
						'MarketingAgreement' => $request->get('agree'),
						'MobilePhone' => $request->get('mobile'),
					],
					'InterfaceCode' => 'WS_CRE_DOUBLE_OPTIN_LEAD',
					'Subsidiary' => 'HMCIS',
					'ExternalSystem' => 'HMCIS_WEB',
				]
			]
		];

		try {
			$response = $client->ProcessMessage($input);
		}
		catch(\Exception $e) {
			return response($e->getMessage());
		}

		$siebel_log = SiebelLog::create([
			'source' => (string)$request->get('source'),
			'type' => 'брошюра',
			'logId' => $response->Payload->Response->LogId,
			'data' => json_encode($input),
		]);

		return response($response->Payload->Response->ResultCode);
	}

	public function requestAddNewsletter(Request $request) {
		if(!($request->ajax() || $request->has('add_newsletter') || $request->get('test') == 555)) {
			die();
		}

		$errors = array();
		$data_ansver = array('code' => 1);

		$validator = Validator::make($request->all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'mobile' => 'required',
			'agree' => [
				'required',
				'max:255',
				function ($attribute, $value, $fail) {
					if ($value !== 'on') {
						$fail('Необходимо согласиться с правилами');
					}
				},
			],
		]);


		if(!$validator->fails()) {
			$wsdl = "public/soap/WS_CRE_NEWS_REQ.WSDL";
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

			$input = [
				'Payload' => [
					'Request' => [
						'Customer' => [
							'FirstName' => $request->get('first_name'),
							'LastName' => $request->get('last_name'),
							'EmailAddress' => $request->get('email'),
							'MarketingAgreement' => $request->get('agree') == 'on' ? 'Y' : 'N',
							'MobilePhone' => $request->get('mobile'),
						],
						'InterfaceCode' => 'WS_CRE_NEWS_REQ',
						'Subsidiary' => 'HMCIS',
						'ExternalSystem' => 'HMCIS_WEB',
					]
				]
			];

			try {
				$response = $client->ProcessMessage($input);
			}
			catch(\Exception $e) {
				return response($e->getMessage());
			}

			if($response->Payload->Response->ResultCode != 'Y')	{
				$errors['crm'] = $response->Payload->Response->ErrorMessage;
			}

			$siebel_log = SiebelLog::create([
				'source' => (string)$request->get('source'),
				'type' => 'подписка на новости',
				'logId' => $response->Payload->Response->LogId,
				'data' => json_encode($input),
			]);

			\App\Helpers\MirHelper::sendContact($request->get('googleId'), $request->get('yandexId'), $request->get('email'), $request->get('mobile'));
		}

		return response('Y');
	}

	public function sendtd(Request $request) {
		$headers = [
			'Content-Type' => 'text/javascript; charset=utf-8',
		];

		$username = env('U_SOAP_SIEBEL_LOGIN');
		$password = env('U_SOAP_SIEBEL_PASSWORD');

		$wsdl = 'public/soap/crm.wsdl';
		$ns = 'http://schemas.xmlsoap.org/ws/2002/07/secext';

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

		$campaignCode = 'HMCIS0001816';

		if($request->get('campaignCode'))
			$campaignCode = $request->get('campaignCode');


		$input = [
			'Payload' => [
				'Request' => [
					'Lead' => [
						'CampaignCode' => $campaignCode,
						'LeadType' => 'Test Drive Request',
						'DealerCode' => $request->get('dealer'),
						'Description' => "Marketing request from homepage",
						'IntendedReplacementPeriod' => '',
						'RequestTime' => '',
						'RequestDate' => date('Ymd'),
						'RequestModel' => trim((string)$request->get('model')),
					],
					'Customer' => [
						'FirstName' => $request->get('name'),
						'LastName' => $request->get('surname'),
						'City' => $request->get('city'),
						'Region' => 'no set',
						'Country' => 'Russia',
						'DateofBirth' => '',
						'EmailAddress' => trim((string)$request->get('email')),
						'Gender' => 'F',
						'HomePhone' => $request->get('phone'),
						'MarketingAgreement' => 'Y',
						'MobilePhone' => $request->get('phone'),
						'PreferredContactChannel' => 'Email',
						'StreetAddress1' => 'no set',
						'StreetAddress2' => 'no set',
						'StreetAddress3' => 'no set',
						'PostCode' => 'no set',
						'Salutation' => $request->get('salutation'),
					],
					'InterfaceCode' => 'WS_CRE_LEAD',
					'Subsidiary' => 'HMCIS',
					'ExternalSystem' => 'HMCIS_WEB',
				]
			]
		];

		try {
			$response = $client->ProcessMessage($input);
			// var_dump($response);
		}
		catch(\Exception $e) {
			return response($e->getMessage())->withHeaders($headers);
		}

		$answ = json_encode($response->Payload->Response);
		return response("({'answer':'".$response->Payload->Response->ResultCode."' , 'answ':".$answ." })")->withHeaders($headers);
	}

	public function sendCrmBeforeZingaya(Request $request) {
		if(!$request->ajax()) {
			die();
		}

		$wsdl = "public/soap/CreateWebCall_V_1.0.WSDL";
		$ns = 'http://schemas.xmlsoap.org/ws/2002/07/secext';

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

		$data = [
			"Payload" => [
				"Request" => [
					"Subsidiary"	 => "HMCIS",
					"ExternalSystem" => "WEBCALL",
					"InterfaceCode"	 => "WS_CRE_WEBCALL",
					"Customer" => [
						"LastName" => $request->get("last_name"),
						"FirstName" => $request->get("first_name"),
						"MiddleName" => $request->get("middle_name"),
						"EmailAddress" => $request->get("email"),
						"MobilePhone" => $request->get("mobile"),
						"DateofBirth" => $request->get("birthdate"),
						"MarketingAgreement" => $request->get("agree"),
					]
				]
			]
		];

		try {
			$response = $client->ProcessMessage($input);
		}
		catch(\Exception $e) {
			return response($e->getMessage())->withHeaders($headers);
		}

		// $siebel_log = SiebelLog::create([
		// 	'source' => (string)$request->get('source'),
		// 	'type' => 'тест-драйв',
		// 	'logId' => $response->Payload->Response->LogId,
		// 	'data' => json_encode($input),
		// ]);

		\App\Helpers\MirHelper::sendContact($request->get('googleId'), $request->get('yandexId'), $request->get('email'), $request->get('mobile'));

		return response($response->Payload->Response->ResultCode);
	}

	public function sendMirTD(Request $request)
	{
		$post = $request->all();

		$params = [
			'model' => isset($post['model']) ? $post['model'] : '',
			'code' => isset($post['dealer']) ? $post['dealer'] : 'HMCIS0005321',
			'email' => isset($post['email']) ? $post['email'] : '',
			'phone' => isset($post['phone']) ? $post['phone'] : '',
			'datetime' => time(),
			'comment' => isset($post['comment']) ? $post['comment'] : '',
			'lead' => isset($post['mrOrms']) ? $post['mrOrms'] : '',
		];

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://mir.hyundai.ru/rest-hyundai/user-record-test-drive');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-V2-ACCESS-KEY: NzwAT3lP0lUMHf_'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
		// curl_setopt($ch, CURLOPT_FAILONERROR, 0);
		// curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2');

		try {
			$response = curl_exec($ch);
			$info = curl_getinfo($ch);
		}
		catch (Exception $e) {
			$filepath = $_SERVER['DOCUMENT_ROOT'] . '/crm_log/mir_api_error_testdrive_' . date('Y_m_d') . '.log';
			$fs = fopen($filepath, 'a+');
			fwrite($fs, '---' . PHP_EOL);
			fwrite($fs, 'testdrive ' . date('Y-m-d H:i:s') .  PHP_EOL);
			ob_start();
			var_dump($params);
			$fout = ob_get_clean();
			fwrite($fs, $fout . PHP_EOL);
			fwrite($fs, $e->getMessage());
			fclose($fs);
		}

		curl_close($ch);

		ob_start();
		var_dump($_GET);
		$output = ob_get_clean();

		$filepath = $_SERVER['DOCUMENT_ROOT'] . '/crm_log/mir_api_testdrive_' . date('Y_m_d') . '.log';
		$fs = fopen($filepath, 'a+');
		fwrite($fs, '---' . PHP_EOL);
		fwrite($fs, 'testdrive ' . date('Y-m-d H:i:s') .  PHP_EOL);
		ob_start();
		var_dump($params);
		$fout = ob_get_clean();
		fwrite($fs, $fout . PHP_EOL);
		ob_start();
		var_dump($info);
		$fout = ob_get_clean();
		fwrite($fs, $fout . PHP_EOL);
		ob_start();
		var_dump($response);
		$fout = ob_get_clean();
		fwrite($fs, $fout . PHP_EOL);
		fclose($fs);
	}

	public function sendMirTO(Request $request)
	{
		$post = $request->all();

		$params = [
			'model' => isset($post['model']) ? $post['model'] : '',
			'code' => isset($post['dealer']) ? $post['dealer'] : 'HMCIS0005321',
			'email' => isset($post['email']) ? $post['email'] : '',
			'phone' => isset($post['phone']) ? $post['phone'] : '',
			'datetime' => time(),
			'comment' => isset($post['comment']) ? $post['comment'] : '',
			'lead' => isset($post['mrOrms']) ? $post['mrOrms'] : '',
		];

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://mir.hyundai.ru/rest-hyundai/user-record-service');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-V2-ACCESS-KEY: NzwAT3lP0lUMHf_'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
		// curl_setopt($ch, CURLOPT_FAILONERROR, 0);
		// curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2');

		try {
			$response = curl_exec($ch);
			$info = curl_getinfo($ch);
		}
		catch (Exception $e) {
			$filepath = $_SERVER['DOCUMENT_ROOT'] . '/crm_log/mir_api_error_service_' . date('Y_m_d') . '.log';
			$fs = fopen($filepath, 'a+');
			fwrite($fs, '---' . PHP_EOL);
			fwrite($fs, 'service ' . date('Y-m-d H:i:s') .  PHP_EOL);
			ob_start();
			var_dump($params);
			$fout = ob_get_clean();
			fwrite($fs, $fout . PHP_EOL);
			fwrite($fs, $e->getMessage());
			fclose($fs);
		}

		curl_close($ch);

		ob_start();
		var_dump($_GET);
		$output = ob_get_clean();

		$filepath = $_SERVER['DOCUMENT_ROOT'] . '/crm_log/mir_api_service_' . date('Y_m_d') . '.log';
		$fs = fopen($filepath, 'a+');
		fwrite($fs, '---' . PHP_EOL);
		fwrite($fs, 'service ' . date('Y-m-d H:i:s') .  PHP_EOL);
		ob_start();
		var_dump($params);
		$fout = ob_get_clean();
		fwrite($fs, $fout . PHP_EOL);
		ob_start();
		var_dump($info);
		$fout = ob_get_clean();
		fwrite($fs, $fout . PHP_EOL);
		ob_start();
		var_dump($response);
		$fout = ob_get_clean();
		fwrite($fs, $fout . PHP_EOL);
		fclose($fs);
	}
}
