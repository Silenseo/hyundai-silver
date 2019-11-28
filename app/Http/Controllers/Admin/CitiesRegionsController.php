<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\CitiesRegion;

class CitiesRegionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:regions_admin_main');
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
        $items = new CitiesRegion;
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
        return view('admin.cities.index', [
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
        $item = new CitiesRegion();
        return view('admin.cities.create', [
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
        $item = new CitiesRegion();

        $item->longitude = $request->get('longitude');
        $item->latitude = $request->get('latitude');
        $item->zoom = $request->get('zoom');
        $item->order = $request->get('order');
        $item->name = $request->get('name');
        $item->name_en = $request->get('name_en');
        $item->name_fi = $request->get('name_fi');
        $item->name_de = $request->get('name_de');

        $item->save();

        return redirect()->route('admin.cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = CitiesRegion::findOrFail($id);
        return view('admin.cities.edit', [
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
        $item = CitiesRegion::findOrFail($id);

        $item->longitude = $request->get('longitude');
        $item->latitude = $request->get('latitude');
        $item->zoom = $request->get('zoom');
        $item->order = $request->get('order');
        $item->name = $request->get('name');
        $item->name_en = $request->get('name_en');
        $item->name_fi = $request->get('name_fi');
        $item->name_de = $request->get('name_de');

        $item->save();

        return redirect()->route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CitiesRegion::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
