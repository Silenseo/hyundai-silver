<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\AccessoriesCategory;

class AccessoriesCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:accessories_admin_main');
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
        $items = new AccessoriesCategory;
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($items->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
        }
        $items = $items->paginate(20);
        return view('admin.accessories.categories.index', [
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
        $item = new AccessoriesCategory();
        return view('admin.accessories.categories.create', [
            'item' => $item,
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
        $item = new AccessoriesCategory();

        $item->name = $request->get('name');
        $item->subtitle = $request->get('subtitle');

        $item->order = $request->get('order');
        $item->visible = (bool)$request->get('visible');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/accessories/categories', $filename);
            
            $item->image = $filename;
        }

        $item->save();

        return redirect()->route('admin.accessories_categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AccessoriesCategory::findOrFail($id);
        return view('admin.accessories.categories.edit', [
            'item' => $item,
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
        $item = AccessoriesCategory::findOrFail($id);

        $item->name = $request->get('name');
        $item->subtitle = $request->get('subtitle');

        $item->order = $request->get('order');
        $item->visible = (bool)$request->get('visible');

        if ($request->hasFile('image')) {
            $oldFile = $item->image;

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/accessories/categories', $filename);
            
            $item->image = $filename;

            Storage::disk('public')->delete('accessories/categories/' . $oldFile);
        }

        $item->save();

        return redirect()->route('admin.accessories_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AccessoriesCategory::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
