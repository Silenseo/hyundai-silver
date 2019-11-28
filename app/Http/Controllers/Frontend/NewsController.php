<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\News;

class NewsController extends Controller
{
    public function __construct() {}

    public function getNews() {
        $p_active = array(
            "on" =>
                array(
                    0 => "true",
                    1 => "false",
                    2 => "false",
                )
        );
        $news = News::where('visible', 1)->orderBy('desc')->paginate(20);

        $page = (int)$request->get('page');
        if($page > $news->lastPage()) {
            abort(404);
        }

        return response($news);
    }

    public function searchCategory(Request $request) {
        $post = $request->all();
        $p_active = array("on" =>
            array(
                0 => $post['v_category'] == 'News' ? 'true' : 'false',
                1 => $post['v_category'] == 'PressRelease' ? 'true' : 'false',
                2 => "false",)
        );

        if ($post['date_start'] == ''){
            $startDate = '1.1.2007';
        } else {
            $startDate = $post['date_start'];
        }
        if($post['date_end'] == ''){
            $endDate = date('d.m.Y');
        } else {
            $endDate = $post['date_end'];
        }

        $items = News::whereBetween('date', [$startDate, $endDate]);

        if($post['wheres']) {
            $wheres = $post['wheres'];
            $items = $items->where(function($query) use ($wheres) {
                $query->where('title', 'LIKE', "%$wheres%")->orWhere('text', 'LIKE', "%$wheres%");
            });
        }

        $items = $items->paginate(20);

        $page = (int)$request->get('page');
        if($page > $items->lastPage()) {
            abort(404);
        }

        return response($items);
    }

    public function blogNews(Request $request) {
        $p_active = array(
            "on" =>
                array(
                    0 => "true",
                    1 => "false",
                    2 => "false",
                )
        );

        if (!$request->get('id')) {
            return redirect('/');
        }

        $url = $request->get('id');
        $item = News::where('url', $url)->first();

        // $item->hits = $item->hits + 1;
        // try {
        //     $item->save();
        // } catch (Exception $e) {
        // }

        //???
    }
}