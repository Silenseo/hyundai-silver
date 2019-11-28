<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Car;
use App\WarrantyCar;

class WarrantyCarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        // $items = WarrantyCar::with('car')
        //     ->join('cars', 'cars.id', '=', 'warranty_cars.car_id')
        //     ->orderBy('cars.name')
        //     ->select('warranty_cars.*')
        //     ->paginate(20);

        $item = new WarrantyCar;
        $items = WarrantyCar::with('car')->join('cars', 'cars.id', '=', 'warranty_cars.car_id');
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($item->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
            else {
                if($sort_field == 'car__name') {
                    $items = $items->orderBy('cars.name', $sort_order);
                }
            }
        }
        $items = $items->select('warranty_cars.*')->paginate(20);

        return view('admin.warranty_cars.index', [
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
        $item = new WarrantyCar();
        $cars = Car::orderBy('name')->get()->pluck('name', 'id');
        return view('admin.warranty_cars.create', [
            'item' => $item,
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
        $item = new WarrantyCar();

        $item->name = $request->get('name');
        $item->period = $request->get('period');
        $item->mileage = $request->get('mileage');
        $item->description = $request->get('description');
        $item->car_id = $request->get('car_id');
        $item->sort = $request->get('sort');
        $item->is_active = (bool)$request->get('is_active');

        $item->save();

        return redirect()->route('admin.warranty_cars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = WarrantyCar::findOrFail($id);
        $cars = Car::orderBy('name')->get()->pluck('name', 'id');
        return view('admin.warranty_cars.edit', [
            'item' => $item,
            'cars' => $cars,
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
        $item = WarrantyCar::findOrFail($id);

        $item->name = $request->get('name');
        $item->period = $request->get('period');
        $item->mileage = $request->get('mileage');
        $item->description = $request->get('description');
        $item->car_id = $request->get('car_id');
        $item->sort = $request->get('sort');
        $item->is_active = (bool)$request->get('is_active');

        $item->save();

        return redirect()->route('admin.warranty_cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = WarrantyCar::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
