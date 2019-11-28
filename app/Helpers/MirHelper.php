<?php

namespace App\Helpers;

class MirHelper {
	public static function sendContact($google_cid, $yandex_cid, $email, $phone)
	{
		$url = 'https://mir.hyundai.ru/api2/v1/analytic';

		$headers = array(
			"Content-type: application/json",
			"Accept: application/json",
			"X-API2-ACCESS-KEY: yd4Qppwliqg9POrSSRLt2iFd8PDeSAa_"
		);

		$postData = Array(
			'google_cid' => $google_cid,
			'yandex_cid' => $yandex_cid,
			'email' => $email,
			'phone' => $phone
		);

		$postData = json_encode($postData);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU");

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

		$result = curl_exec($ch);
	}
}
