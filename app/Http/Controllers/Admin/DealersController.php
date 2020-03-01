<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\Exports\DealersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\CitiesRegion;
use App\Dealer;

class DealersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:dealers_admin_main');
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

        $items = new Dealer;
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
                if(\Schema::hasColumn($table_name, $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
        }

        $items = $items->paginate(20);

        return view('admin.dealers.index', [
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
        $item = new Dealer();
        $cities = CitiesRegion::orderBy('name')->get()->pluck('name', 'id');
        return view('admin.dealers.create', [
            'item' => $item,
            'cities' => $cities,
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
        $item = new Dealer();

        $item->name = $request->get('name');
        $item->address = $request->get('address');
        $item->phone = $request->get('phone');
        $item->email = $request->get('email');
        $item->code = $request->get('code');
        $item->rc_code = $request->get('rc_code');
        $item->site = $request->get('site');
        $item->latitude = $request->get('latitude');
        $item->longitude = $request->get('longitude');
        $item->visible = (bool)$request->get('visible');
        $item->zyngaya = $request->get('zyngaya');
        $item->city_id = $request->get('city_id');
        $item->special = (bool)$request->get('special');
        $item->wa = (bool)$request->get('wa');
        // $item->hidden = (bool)$request->get('hidden');
        $item->rating = (bool)$request->get('rating');
        $item->prohibition_requests = (bool)$request->get('prohibition_requests');
        $item->credit_id = $request->get('credit_id');
        $item->i30n = (bool)$request->get('i30n');
        $item->token = $request->get('token');
        $item->legal_name = $request->get('legal_name');
        $item->legal_address = $request->get('legal_address');

        $item->save();

        return redirect()->route('admin.dealers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Dealer::findOrFail($id);
        $cities = CitiesRegion::orderBy('name')->get()->pluck('name', 'id');
        return view('admin.dealers.edit', [
            'item' => $item,
            'cities' => $cities,
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
        $item = Dealer::findOrFail($id);

        $item->name = $request->get('name');
        $item->address = $request->get('address');
        $item->phone = $request->get('phone');
        $item->email = $request->get('email');
        $item->code = $request->get('code');
        $item->rc_code = $request->get('rc_code');
        $item->site = $request->get('site');
        $item->latitude = $request->get('latitude');
        $item->longitude = $request->get('longitude');
        $item->visible = (bool)$request->get('visible');
        $item->zyngaya = $request->get('zyngaya');
        $item->city_id = $request->get('city_id');
        $item->special = (bool)$request->get('special');
        $item->wa = (bool)$request->get('wa');
        // $item->hidden = (bool)$request->get('hidden');
        $item->rating = (bool)$request->get('rating');
        $item->prohibition_requests = (bool)$request->get('prohibition_requests');
        $item->credit_id = $request->get('credit_id');
        $item->i30n = (bool)$request->get('i30n');
        $item->token = $request->get('token');
        $item->legal_name = $request->get('legal_name');
        $item->legal_address = $request->get('legal_address');

        $item->save();

        return redirect()->route('admin.dealers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Dealer::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }

    public function downloadXLS()
    {
        return Excel::download(new DealersExport, 'dealers.xlsx');
    }
}
