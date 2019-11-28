<?php

namespace App\Helpers;

class NumberHelper {
	public static function formatDateMonth($date) {
		$months = ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];
		$months_x = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];

		$month = $months_x[date('n', $date) - 1];
		$day = date('j', $date);

		return $day . ' ' . $month;
	}
}