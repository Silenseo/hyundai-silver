<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\BrandcollectionCategory;
use App\BrandcollectionProduct;
use App\BrandcollectionTag;

class BrandcollectionController extends Controller
{
    private $menu_cats;

    public function __construct()
    {
        $this->menu_cats = BrandcollectionCategory::where('is_active', 1)->orderBy('sort')->get();
    }

    public function index(Request $request)
    {
        $items = BrandcollectionProduct::where('is_active', 1)->orderBy('is_new', 'DESC')->orderBy('sort')->take(12)->get();

        return view('frontend.brandCollection.index',[
            'header' => true,
            'highlight' => false,
            'footer' => true,
            'items' => $items,
            'menu_cats' => $this->menu_cats,
        ]);
    }

    public function category($code, Request $request)
    {
        $category = BrandcollectionCategory::where('code', $code)->first();
        $items = $category->products()->where('is_active', 1)->with('tag')->get();
        $tags = [];
        foreach($items as $item) {
            if($item->tag->is_active) {
                if(!isset($tags[$item->tag->id])) {
                    $tags[$item->tag->id] = $item->tag;
                }
            }
        }
        uasort($tags, function($a, $b) {
            return strcmp($a->name, $b->name);
        });

        return view('frontend.brandCollection.product',[
            'header' => true,
            'highlight' => false,
            'footer' => true,
            'items' => $items,
            'menu_cats' => $this->menu_cats,
            'category' => $category,
            'tags' => $tags,
        ]);
    }

    public function all(Request $request)
    {
        $items = BrandcollectionProduct::where('is_active', 1)->with('tag')->get();
        $tags = [];
        foreach($items as $item) {
            if($item->tag->is_active) {
                if(!isset($tags[$item->tag->id])) {
                    $tags[$item->tag->id] = $item->tag;
                }
            }
        }
        uasort($tags, function($a, $b) {
            return strcmp($a->name, $b->name);
        });

        return view('frontend.brandCollection.product',[
            'header' => true,
            'highlight' => false,
            'footer' => true,
            'items' => $items,
            'menu_cats' => $this->menu_cats,
            'tags' => $tags,
        ]);
    }

    public function map(Request $request)
    {
        return view('frontend.brandCollection.map',[
            'header' => true,
            'highlight' => false,
            'footer' => true,
            'menu_cats' => $this->menu_cats,
        ]);
    }
}
