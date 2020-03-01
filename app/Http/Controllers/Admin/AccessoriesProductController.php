<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\AccessoriesCategory;
use App\AccessoriesProduct;
use App\Car;

class AccessoriesProductController extends Controller
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
        $request_arr = $request->all();
        $where_arr = [];
        foreach($request_arr as $r_key => $r_val) {
            preg_match('/search_(.*)/', $r_key, $matches);
            if(isset($matches[1])) {
                $where_arr[$matches[1]] = $r_val;
            }
        }

        $items = new AccessoriesProduct;
        $table_name = $items->getTable();

        $table_columns_types = [];
        $table_info_columns = \DB::select(\DB::raw("SHOW COLUMNS FROM {$table_name}"));
        foreach($table_info_columns as $column) {
            $table_columns_types[$column->Field] = $column->Type;
        }

        foreach($where_arr as $w_field => $w_val) {
            if(\Schema::hasColumn($table_name, $w_field)) {
                if(strpos($table_columns_types[$w_field], 'varchar') !== false || strpos($table_columns_types[$w_field], 'text') !== false) {
                    $items = $items->where($w_field, 'like', "%{$w_val}%");
                }
                else {
                    $items = $items->where($w_field, '=', $w_val);
                }
            }
        }

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
        return view('admin.accessories.products.index', [
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
        $item = new AccessoriesProduct();
        $categories = AccessoriesCategory::orderBy('name')->get()->pluck('name', 'id');
        $cars = Car::orderBy('name')->get();
        return view('admin.accessories.products.create', [
            'item' => $item,
            'categories' => $categories,
            'cars' => $cars,
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
        $item = new AccessoriesProduct();

        $item->category_id = (int)$request->get('category_id');
        $item->name = $request->get('name');
        $item->article = $request->get('article');
        $item->price = $request->get('price');

        $item->specs = $request->get('specs');
        $item->description = $request->get('description');

        $item->order = $request->get('order');
        $item->visible = (bool)$request->get('visible');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/accessories/products', $filename);
            
            $item->image = $filename;
        }

        $item->save();

        $carsPrices = $request->get('car_price');
        $cars = Car::whereIn('id', $request->get('car_selected'))->get();
        $carsSyncArr = [];
        if($cars->count() > 0) {
            foreach($cars as $car) {
                $carsSyncArr[$car->id] = ['price' => $carsPrices[$car->id]];
            }
        }
        $item->cars()->sync($carsSyncArr);

        return redirect()->route('admin.accessories_products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AccessoriesProduct::findOrFail($id);
        $categories = AccessoriesCategory::orderBy('name')->get()->pluck('name', 'id');
        $cars = Car::orderBy('name')->get();
        $cars_selected = $item->cars()->pluck('accessories_product_car.price', 'car_id');
        return view('admin.accessories.products.edit', [
            'item' => $item,
            'categories' => $categories,
            'cars' => $cars,
            'cars_selected' => $cars_selected,
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
        $item = AccessoriesProduct::findOrFail($id);

        $item->category_id = $request->get('category_id');
        $item->name = $request->get('name');
        $item->article = $request->get('article');
        $item->price = $request->get('price');

        $item->specs = $request->get('specs');
        $item->description = $request->get('description');

        $item->order = $request->get('order');
        $item->visible = (bool)$request->get('visible');

        if ($request->hasFile('image')) {
            $oldFile = $item->image;

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/accessories/products', $filename);
            
            $item->image = $filename;

            Storage::disk('public')->delete('accessories/products/' . $oldFile);
        }

        $item->save();

        $carsPrices = $request->get('car_price');
        $cars = Car::whereIn('id', $request->get('car_selected'))->get();
        $carsSyncArr = [];
        if($cars->count() > 0) {
            foreach($cars as $car) {
                $carsSyncArr[$car->id] = ['price' => $carsPrices[$car->id]];
            }
        }
        $item->cars()->sync($carsSyncArr);

        return redirect()->route('admin.accessories_products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AccessoriesProduct::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
