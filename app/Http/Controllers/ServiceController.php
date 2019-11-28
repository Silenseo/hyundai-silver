<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\Car;

class ServiceController extends Controller
{

	public function shell() {
		$f = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/media/shell/shell.csv');

		$f = explode("\n", $f);

		$carCode = '';
		$engineCode = '';
		$volume = '';

		$Result = Array();
		$Volumes = Array();

		foreach($f as $row)
		{
			$row = explode(';', $row);

			if(count($row) < 5) continue;

			if(strlen($row[0]) > 0)
				$carCode = $row[0];

			if(strlen($row[1]) > 0)
				$engineCode = $row[1];

			// Годы производства

			if(strlen($row[2]) > 0)
				$Result[$carCode]['from'] = $row[2];

			if(strlen($row[3]) > 0)
				$Result[$carCode]['to'] = is_numeric($row[3]) ? $row[3] : 0;

			if(strlen($row[5]) > 0)
				$Result[$carCode]['engines'][$engineCode][] = $row[5];

			if(strlen($row[4]) > 0)
				$volume = $row[4];

			if(strlen($carCode) > 0 && strlen($engineCode) > 0)
				$Volumes[$carCode][strval($engineCode)] = $volume;
		}

		// Пересоберем
		$tmp = Array();

		foreach($Result as $carCode => $row)
		{
			if(strpos(strtolower($carCode), 'solaris') === false) continue;

			$tmpBlock = Array(
				'name' => str_replace('*', '', $carCode),
				'image' => strtolower(str_replace(Array(' ', '*'), '', $carCode)),
				'from' => $row['from'],
				'to' => $row['to']
			);

			foreach($row['engines'] as $engineCode => $oilList)
				$tmpBlock['engines'][] = Array(
					'name' => $engineCode,
					'volume' => $Volumes[$carCode][$engineCode],
					'values' => $oilList,
				);

			$tmp[] = $tmpBlock;
		}


/*
		var_dump($Result); exit;
		var_dump($Volumes); exit;
*/


		foreach($Result as $carCode => $row)
		{
			if(strpos(strtolower($carCode), 'solaris') !== false) continue;

			$tmpBlock = Array(
				'name' => str_replace('*', '', $carCode),
				'image' => strtolower(str_replace(Array(' ', '*'), '', $carCode)),
				'from' => $row['from'],
				'to' => isset($row['to']) ? $row['to'] : 0
			);

			foreach($row['engines'] as $engineCode => $oilList)
				$tmpBlock['engines'][] = Array(
					'name' => $engineCode,
					'volume' => @$Volumes[$carCode][$engineCode],
					'values' => $oilList
				);

			$tmp[] = $tmpBlock;
		}


		$Result = $tmp;

		return view(
			'frontend.service.shell',
			[
				'highlight' => false,
				'data' => $Result
			]
		);

	}

	public function manuals(Request $request) {
		$cars = Car::with('manuals')->where('visible', 1)->has('manuals')->orderBy('name')->get();

		return view('frontend.service.documentation', [
			'header' => true,
			'highlight' => false,
			'footer' => true,
			'cars' => $cars,
		]);
	}
}
