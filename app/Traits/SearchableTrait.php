<?php

namespace App\Traits;

trait SearchableTrait
{
	// protected $searchableFields = [];

	public function scopeSimpleSearch($query, $searchString) {
		$fields = $this->searchableFields;
		$string = strtolower(trim($searchString));

		$modelFields = [];
		$relationFields = [];
		foreach($fields as $field) {
			if(strpos($field, '.') !== false) {
				$t = explode('.', $field);
				$relationFields[$t[0]][] = $t[1];
			}
			else {
				$modelFields[] = $field;
			}
		}

		if(strlen($string) > 0) {
			$query->where(function($q) use ($string, $modelFields, $relationFields) {
				foreach($modelFields as $f) {
					$q->orWhere($f, 'like', "%{$string}%");
				}
				foreach($relationFields as $k => $fields) {
					$q->orWhereHas($k ,function($sq) use ($string, $fields) {
						$sq->where(function($ssq) use($string, $fields) {
							foreach($fields as $f) {
								$ssq->orWhere($f, 'like', "%{$string}%");
							}
						});
					});
				}
			});
		}

		return $query;
	}
}
