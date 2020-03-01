<?php

namespace App\Traits;

trait MirTrait
{
	public function sendMirTD(\Illuminate\Http\Request $request)
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

	public function sendMirTO(\Illuminate\Http\Request $request)
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