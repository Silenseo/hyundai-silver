<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;

use App\Car;
use App\CitiesRegion;
use App\Dealer;
use App\Jobseeker;
use App\MotorstudioRequest;
use App\SiebelLog;

class FormsController extends \App\Http\Controllers\Controller
{
	public function sendTestDrive(Request $request) {
		$rdata = $request->all();

		if(!isset($rdata['modelId']) && !isset($rdata['modelCode'])) {
			return response()->json([
				'status' => 0,
				'error' => '',
			]);
		}

		$validator = Validator::make($rdata, [
//			'dealer' => 'required|exists:dealers,code',
			'salutation' => 'required',
			'name' => 'required',
			'sirname' => 'required',
			'email' => 'required',
			'phone' => 'required',
		]);

		if($validator->fails()) {
			return response()->json([
				'status' => 0,
				'error' => $validator->errors()->first(),
			]);
		}

      $emailTo = env('DEALER_EMAIL');

      $mess = 'Оставлена заявка на тест-драйв' . "\n\n";
      $mess .= 'Модель авто: ' . $rdata['modelCode'] . "\n\n";
      $mess .= 'ФИО:' . (string)$request->get('name') . ' ' . (string)$request->get('sirname') . "\n\n";
      $mess .= 'E-Mail: ' . (string)$request->get('email') . "\n\n";
      $mess .= 'Телефон:' . (string)$request->get('phone') . "\n\n";
      
      
      Mail::raw($mess, function ($message){
																	$message
																		->to('web@investmarketing.ru')
																		->to('silvermotorshyundai@gmail.com')
																		->to('mksm@hyundai-silver.ru')
																		->subject('Заявка на тест-драйв');
                                });
      
/*
		$siebel_code = $rdata['modelCode'] ?? '';
		if(isset($rdata['modelId']) && $rdata['modelId'] > 0) {
			$car = Car::find($rdata['modelId']);
			if(!$car) {
				return response()->json([
					'status' => 0,
					'error' => 'Car not found',
				]);
			}

			$siebel_code = $car->siebel_code;
		}

		$username = env('U_SOAP_SIEBEL_LOGIN');
		$password = env('U_SOAP_SIEBEL_PASSWORD');

		$wsdl = $_SERVER['DOCUMENT_ROOT'] . '/soap/crm.wsdl';
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

		$input = [
			'Payload' => [
				'Request' => [
					'Lead' => [
						'CampaignCode' => (string)$request->get('campaignCode'),
						'LeadType' => 'Test Drive Request',
						'DealerCode' => $request->get('dealer'),
						'Description' => '',
						'IntendedReplacementPeriod' => '',
						'RequestTime' => '',
						'RequestDate' => date('Ymd'),
						'RequestModel' => $siebel_code,
					],
					'Customer' => [
						'FirstName' => (string)$request->get('name'),
						'LastName' => (string)$request->get('sirname'),
						'City' => (string)$request->get('city'),
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
		}
		catch(\Exception $e) {
			return response()->json([
				'status' => 0,
				'error' => $e->getMessage()
			]);
		}

		$is_success = $response->Payload->Response->ResultCode;

		$siebel_log = SiebelLog::create([
			'source' => (string)$request->get('source'),
			'type' => 'test drive',
			'logId' => $response->Payload->Response->LogId,
			'data' => json_encode($input),
		]);

		if(!$is_success) {
			return response()->json([
				'status' => 0,
				'error' => 'soap error'
			]);
		}
*/

		return response()->json(['status' => 1]);
	}

	public function sendServiceRequest(Request $request) {
		$rdata = $request->all();

		if(!isset($rdata['modelId']) && !isset($rdata['modelCode'])) {
			return response()->json([
				'status' => 0,
				'error' => '',
			]);
		}

		$validator = Validator::make($rdata, [
//			'dealer' => 'required|exists:dealers,code',
			'salutation' => 'required',
			'name' => 'required',
			'sirname' => 'required',
			'email' => 'required',
			'phone' => 'required',
		]);

		if($validator->fails()) {
			return response()->json([
				'status' => 0,
				'error' => $validator->errors()->all(),
			]);
		}

		$mess = 'Оставлена заявка на ТО' . "\n\n";

$mess .= 'Модель авто: ' . $rdata['modelCode'] . "\n\n";
$mess .= 'ФИО:' . (string)$request->get('name') . ' ' . (string)$request->get('sirname') . "\n\n";
$mess .= 'E-Mail: ' . (string)$request->get('email') . "\n\n";
$mess .= 'Телефон:' . (string)$request->get('phone') . "\n\n";

    $emailTo = env('DEALER_EMAIL');

		Mail::raw($mess, function ($message){
            $message
								->to('web@investmarketing.ru')
								->to('silvermotorshyundai@gmail.com')
								->to('mksm@hyundai-silver.ru')
                ->subject('Заявка на техническое обслуживание');
        });

/*
		$siebel_code = $rdata['modelCode'] ?? '';
		if(isset($rdata['modelId']) && $rdata['modelId'] > 0) {
			$car = Car::find($rdata['modelId']);
			if(!$car) {
				return response()->json([
					'status' => 0,
					'error' => 'Car not found',
				]);
			}

			$siebel_code = $car->siebel_code;
		}

		$username = env('U_SOAP_SIEBEL_LOGIN');
		$password = env('U_SOAP_SIEBEL_PASSWORD');

		$wsdl = $_SERVER['DOCUMENT_ROOT'] . '/soap/WS_CRE_LEAD_V.1.6_REQUEST.WSDL';
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

		$input = [
			'Payload' => [
				'Request' => [
					'Lead' => [
						'CampaignCode' => (string)$request->get('campaignCode'),
						'LeadType' => 'Technical Maintenance Request',
						'ServiceType' => (string)$request->get('model_engine_type'),
						'DealerCode' => $request->get('dealer'),
						'Description' => '',
						'IntendedReplacementPeriod' => '',
						'RequestTime' => '',
						'RequestDate' => date('Ymd'),
						'RequestModel' => $siebel_code,
					],
					'Customer' => [
						'FirstName' => (string)$request->get('name'),
						'LastName' => (string)$request->get('sirname'),
						'City' => (string)$request->get('city'),
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
		}
		catch(\Exception $e) {
			return response()->json([
				'status' => 0,
				'error' => $e->getMessage()
			]);
		}

		$is_success = $response->Payload->Response->ResultCode;

		$siebel_log = SiebelLog::create([
			'source' => (string)$request->get('source'),
			'type' => 'service request',
			'logId' => $response->Payload->Response->LogId,
			'data' => json_encode($input),
		]);

		if(!$is_success) {
			return response()->json([
				'status' => 0,
				'error' => 'soap error'
			]);
		}

		$to = $rdata['email'];
		$subject = 'Hyundai. Запись на ТО';
		$from = 'webmaster@hyundai.ru';

		Mail::to($to)->send(new \App\Mail\ServiceRequest($subject, $rdata));
*/

		return response()->json(['status' => 1]);
	}

	public function offerCreditRequest(Request $request) {

    	/*
        $input = [
            'Payload' => [
                'Request' => [
                    'Lead' => [
                        //'CampaignCode' => 'HMCIS0006146',
                        'CampaignCode' => 'HMCIS0000183',
                        'LeadType' => 'Credit Inquiry Request',
                        'DealerCode' => Arr::get($post,'dealer'),
                        'Description' => 'Marketing request from homepage',
                        'IntendedReplacementPeriod' => '',
                        'RequestTime' => '',
                        'RequestDate' => date('Ymd'),
                        'RequestModel' => $model,
                    ],
                    'Customer' => [
                        'FirstName' => Arr::get($post,'name'),
                        'LastName' => Arr::get($post,'surname'),
                        'City' => Arr::get($post,'city'),
                        'Region' => 'no set',
                        'Country' => 'Russia',
                        'DateofBirth' => '',
                        'EmailAddress' => trim(Arr::get($post,'email')),
                        'Gender' => 'M',
                        'HomePhone' => Arr::get($post,'phone'),
                        'MarketingAgreement' => 'Y',
                        'MobilePhone' => Arr::get($post,'phone'),
                        'PreferredContactChannel' => 'Email',
                        'StreetAddress1' => 'no set',
                        'StreetAddress2' => 'no set',
                        'StreetAddress3' => 'no set',
                        'PostCode' => 'no set',
                        'Salutation' => Arr::get($post,'salutation'),
                    ],
                    'Attachment' => [
	                    [
		                    'FileExt' => 'pdf',
		                    'FileName' => 'test',
		                    'FileSize' => 0, //filesize($_SERVER['DOCUMENT_ROOT'] . '/pdf/config_1550758537.pdf'),
		                    'FileBuffer' => '',//file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/pdf/config_1550758537.pdf')
		                ]
                    ],
                    'InterfaceCode' => 'WS_CRE_LEAD',
                    'Subsidiary' => 'HMCIS',
                    'ExternalSystem' => 'HMCIS_WEB',
                ]
            ]
        ];


    	*/


    	$rdata = $request->all();

		if(!isset($rdata['modelId']) && !isset($rdata['modelCode'])) {
			return response()->json([
				'status' => 0,
				'error' => '',
			]);
		}

		$validator = Validator::make($rdata, [
//			'dealer' => 'required|exists:dealers,code',
			'salutation' => 'required',
			'name' => 'required',
			'sirname' => 'required',
			'email' => 'required',
			'phone' => 'required',
		]);

		if($validator->fails()) {
			return response()->json([
				'status' => 0,
				'error' => $validator->errors()->first(),
			]);
		}

		$siebel_code = $rdata['modelCode'] ?? '';
		if(isset($rdata['modelId']) && $rdata['modelId'] > 0) {
			$car = Car::find($rdata['modelId']);
			if(!$car) {
				return response()->json([
					'status' => 0,
					'error' => 'Car not found',
				]);
			}

			$siebel_code = $car->siebel_code;
		}


    	$username = env('U_SOAP_SIEBEL_LOGIN');
		$password = env('U_SOAP_SIEBEL_PASSWORD');

		$wsdl = $_SERVER['DOCUMENT_ROOT'] . '/soap/WS_CRE_LEAD_V.1.6_REQUEST.WSDL';
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


		$input = [
            'Payload' => [
                'Request' => [
                    'Lead' => [
                        //'CampaignCode' => 'HMCIS0006146',
                        'CampaignCode' => 'HMCIS0000183',
                        'LeadType' => 'Credit Inquiry Request',
                        'DealerCode' => $request->get('dealer'),
                        'Description' => 'Marketing request from homepage',
                        'IntendedReplacementPeriod' => '',
                        'RequestTime' => '',
                        'RequestDate' => date('Ymd'),
                        'RequestModel' => $siebel_code,
                    ],
                    'Customer' => [
						'FirstName' => (string)$request->get('name'),
						'LastName' => (string)$request->get('sirname'),
						'City' => (string)$request->get('city'),
						'Region' => 'no set',
						'Country' => 'Russia',
						'DateofBirth' => '',
						'EmailAddress' => trim((string)$request->get('email')),
						'Gender' => 'M',
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
                    'Attachment' => [
	                    [
		                    'FileExt' => 'pdf',
		                    'FileName' => 'test',
		                    'FileSize' => 0, //filesize($_SERVER['DOCUMENT_ROOT'] . '/pdf/config_1550758537.pdf'),
		                    'FileBuffer' => '',//file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/pdf/config_1550758537.pdf')
		                ]
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
			return response()->json([
				'status' => 0,
				'error' => $e->getMessage()
			]);
		}

		$is_success = $response->Payload->Response->ResultCode;

		$siebel_log = SiebelLog::create([
			'source' => (string)$request->get('source'),
			'type' => 'credit request',
			'logId' => $response->Payload->Response->LogId,
			'data' => json_encode($input),
		]);

		if(!$is_success) {
			return response()->json([
				'status' => 0,
				'error' => 'soap error'
			]);
		}

    	return response()->json(['status' => 1]);
	}

	public function sendStart(Request $request) {


//		return response()->json(['status' => $result]);

        // отпроксируем почту

        //$url = 'https://old.hyundai.ru/requestnew/sendstart?' . http_build_query($_REQUEST);

/*
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($ch);
        $err = curl_error($ch);  //if you need
        curl_close ($ch);
*/

        $carsArr = [];
        $cars = \App\Car::all();
        foreach($cars as $car) {
            $carsArr[$car->conf_id] = [
                'NAME' => $car->name,
                'URL' => "/{$car->id_text}",
                'IMG' => $car->getImageUrl(),
                'TYPE' => '',
            ];
        }

        $data = $request->all();
        $startPlus = $request->get('startPlus');
        $theme = 'Hyundai: Программа "Старт Плюс"';
        if($startPlus)
            $theme = 'Hyundai: Программа "Старт Плюс"';

        Mail::to($data['email'])->send(new \App\Mail\Start($theme, $data, $startPlus, $carsArr));

		return response()->json(['status' => 1]);
	}

	public function checkVin(Request $request) {
		$vin = $request->get('vin');
		$result = 0;
		if(($handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/media/service/vin.csv', 'r')) !== FALSE) {
			while(($data = fgetcsv($handle, 1000)) !== FALSE) {
				$num = count($data);
				for($i = 0; $i < $num; $i++) {
					if($data[$i] == $vin) {
						$result = 1;
						break;
					}
				}
			}
			fclose($handle);
		}

		return response()->json(['status' => $result]);
	}


	public function jobseeker(Request $request) {
		$item = new Jobseeker();
		$item->name = $request->get('name');
		$item->surname = $request->get('surname');
		$item->patronymic = $request->get('patronymic');
		$item->email = $request->get('email');
		$item->tel = $request->get('tel');
		$item->institute = $request->get('institute');
		$item->otherinstitute = $request->get('otherinstitute');
		$item->specialty = $request->get('specialty');
		$item->level = $request->get('level');
		$item->stage = $request->get('stage');
		$item->lang = $request->get('lang');

		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$filename = time() . '.' . $file->getClientOriginalExtension();
			$path = $file->storeAs('main/jobseeker', $filename);
			$item->file = $filename;
		}

		$result = $item->save() ? 1 : 0;

		return response()->json(['status' => $result]);
	}

	public function sendMotorstudioRequest(Request $request) {
		$item = new MotorstudioRequest();
		$item->name = $request->get('name');
		$item->sirname = $request->get('surname');
		$item->email = $request->get('email');
		$item->phone = $request->get('tel');
		$item->age = $request->get('age');
		$item->date = time();
		$item->event_id = $request->get('id');

		$result = $item->save() ? 1 : 0;

		return response()->json(['status' => $result]);
	}

	public function sendEventRequest(Request $request) {
		$item = new \App\MotorstudioEventRequest();
		$item->title = $request->get('title');
		$item->description = $request->get('description');
		$item->date = $request->get('date');
		$item->time = $request->get('time');
		$item->members = $request->get('members');
		$item->guests = $request->get('guests');
		// $item->timing = $request->get('timing');
		$item->catering = (bool)$request->get('catering');
		$item->fio = $request->get('fio');
		$item->email = $request->get('email');
		$item->tel = $request->get('tel');
		$item->about = $request->get('about');

		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$filename = time() . '.' . $file->getClientOriginalExtension();
			$path = $file->storeAs("motorstudio_requests_files", $filename, 'public');
			$item->file = $path;
		}

		$result = $item->save() ? 1 : 0;

		$fields = $item->toArray();
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 'https://old.hyundai.ru/requestnew/sendEventRequest');
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		$curl_result = curl_exec($ch);

		return response()->json(['status' => $result]);
	}
}
