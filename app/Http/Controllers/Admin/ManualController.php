<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Car;
use App\Manual;

class ManualController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:manuals_admin_main');
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
        $items = new Manual;
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($items->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
            else {
                if($sort_field == 'car__name') {
                    $items = $items->join('cars', 'manuals.car_id', '=', 'cars.id')
                        ->orderBy('cars.name', $sort_order)
                        ->select('manuals.*');
                }
            }
        }
        $items = $items->paginate(20);

        return view('admin.manuals.index', [
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
        $item = new Manual();
        $cars = Car::orderBy('name')->get()->pluck('name', 'id');

        return view('admin.manuals.create', [
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
        $item = new Manual();

        $item->name = $request->get('name');
        $item->sort = $request->get('sort');
        $item->is_active = (bool)$request->get('is_active');
        $item->car_id = $request->get('car_id');
        $item->link = $request->get('link');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/manual', $filename);
            $item->file = $filename;
        }

        $item->save();

        return redirect()->route('admin.manuals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Manual::findOrFail($id);
        $cars = Car::orderBy('name')->get()->pluck('name', 'id');

        return view('admin.manuals.edit', [
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
        $item = Manual::findOrFail($id);

        $item->name = $request->get('name');
        $item->sort = $request->get('sort');
        $item->is_active = (bool)$request->get('is_active');
        $item->car_id = $request->get('car_id');
        $item->link = $request->get('link');

        if ($request->hasFile('file')) {
            $oldFile = $item->file;
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/manual', $filename);
            $item->file = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('manual/' . $oldFile);
        }

        $item->save();

        return redirect()->route('admin.manuals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Manual::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
