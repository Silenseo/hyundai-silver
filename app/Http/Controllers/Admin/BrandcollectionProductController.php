<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\BrandcollectionCategory;
use App\BrandcollectionProduct;
use App\BrandcollectionTag;

class BrandcollectionProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:brandcollection_admin_main');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = new BrandcollectionProduct;
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($items->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
            else {
                if($sort_field == 'category__name') {
                    $items = $items->join('brandcollection_categories', 'brandcollection_products.category_id', '=', 'brandcollection_categories.id')
                        ->orderBy('brandcollection_categories.name', $sort_order)
                        ->select('brandcollection_products.*');
                }
                else if($sort_field == 'tag__name') {
                    $items = $items->join('brandcollection_tags', 'brandcollection_products.tag_id', '=', 'brandcollection_tags.id')
                        ->orderBy('brandcollection_tags.name', $sort_order)
                        ->select('brandcollection_products.*');
                }
            }
        }
        $items = $items->paginate(20);

        return view('admin.brandcollection_products.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $item = new BrandcollectionProduct();
        $categories = BrandcollectionCategory::orderBy('name')->get()->pluck('name', 'id');
        $tags = BrandcollectionTag::orderBy('name')->get()->pluck('name', 'id');
        return view('admin.brandcollection_products.create', [
            'item' => $item,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new BrandcollectionProduct();

        $item->name = $request->get('name');
        $item->article = $request->get('article');
        $item->category_id = $request->get('category_id');
        $item->tag_id = $request->get('tag_id');
        $item->price = $request->get('price');
        $item->description = $request->get('description');
        $item->size = $request->get('size');
        $item->material = $request->get('material');
        $item->specifications = $request->get('specifications');
        $item->sort = $request->get('sort');
        $item->is_active = (bool)$request->get('is_active');
        $item->is_new = (bool)$request->get('is_new');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/brandcollection_products', $filename);
            $item->image = $filename;
        }

        $item->save();

        return redirect()->route('admin.brandcollection_products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = BrandcollectionProduct::findOrFail($id);
        $categories = BrandcollectionCategory::orderBy('name')->get()->pluck('name', 'id');
        $tags = BrandcollectionTag::orderBy('name')->get()->pluck('name', 'id');
        return view('admin.brandcollection_products.edit', [
            'item' => $item,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = BrandcollectionProduct::findOrFail($id);

        $item->name = $request->get('name');
        $item->article = $request->get('article');
        $item->category_id = $request->get('category_id');
        $item->tag_id = $request->get('tag_id');
        $item->price = $request->get('price');
        $item->description = $request->get('description');
        $item->size = $request->get('size');
        $item->material = $request->get('material');
        $item->specifications = $request->get('specifications');
        $item->sort = $request->get('sort');
        $item->is_active = (bool)$request->get('is_active');
        $item->is_new = (bool)$request->get('is_new');

        if ($request->hasFile('image')) {
            $oldFile = $item->image;
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/brandcollection_products', $filename);
            $item->image = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('brandcollection_products/' . $oldFile);
        }

        $item->save();

        return redirect()->route('admin.brandcollection_products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = BrandcollectionProduct::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
