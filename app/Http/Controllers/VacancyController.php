<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/*
use App\Car;
use App\News;
*/

class VacancyController extends Controller
{
    public function index() {

        $key = 'vacancy_data';

        if(!Cache::has($key))
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.hh.ru/vacancies?employer_id=140083');
            curl_setopt($ch, CURLOPT_USERAGENT, 'HH-User-Agent');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $vacancies = json_decode(curl_exec($ch), true);
            curl_close($ch);

            $vac_grouped = [];
            foreach($vacancies['items'] as $vac) {
                $vacancy_id = $vac['id'];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://api.hh.ru/vacancies/$vacancy_id");
                curl_setopt($ch, CURLOPT_USERAGENT, 'HH-User-Agent');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $vacancy = json_decode(curl_exec($ch), true);
                curl_close($ch);

                if(isset($vacancy['specializations'][0])) {
                    $vac_grouped[$vacancy['specializations'][0]['profarea_name']][] = $vacancy;
                }
            }

            Cache::put($key, $vac_grouped, 3600);
        }
        else
        {
            $vac_grouped = Cache::get($key);
        }

        return view('frontend.vacancy.index', [
            'highlight' => false,
            'vacancyList' => $vac_grouped
        ]);
	}

	public function detail($id) {
        $key = 'vacancy_' . $id;

        if(!Cache::has($key))
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.hh.ru/vacancies?employer_id=140083');
            curl_setopt($ch, CURLOPT_USERAGENT, 'HH-User-Agent');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $vacancies = (array)json_decode(curl_exec($ch), true);
            curl_close($ch);

            $ids = array_map(function($e) {
                return $e['id'];
            }, $vacancies['items']);

            $vacancy_id = $id;

            if(!in_array($vacancy_id, $ids)) {
                // throw new HTTP_Exception_404('Not found', NULL, 404);
                abort(404);
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hh.ru/vacancies/$id");
            curl_setopt($ch, CURLOPT_USERAGENT, 'HH-User-Agent');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $vacancy = json_decode(curl_exec($ch), true);
            curl_close($ch);

            Cache::put($key, $vacancy, 3600);
        }
        else
        {
            $vacancy = Cache::get($key);
        }

        if(!$vacancy) {
            abort(404);
        }

        return view('frontend.vacancy.page', [
            'vacancy' => $vacancy
        ]);
	}

}
