<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\MotorstudioDeadline;

class MotorstudioDeadlineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:motorstudio_admin_main');
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
        $items = new MotorstudioDeadline;
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

        return view('admin.motorstudio_deadlines.index', [
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
        $item = new MotorstudioDeadline();
        return view('admin.motorstudio_deadlines.create', [
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
        $item = new MotorstudioDeadline();

        $item->closed_from = empty($request->get('date_closed_from_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_closed_from_day') . ' ' . $request->get('date_closed_from_time')));
        $item->closed_to = empty($request->get('date_closed_to_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_closed_to_day') . ' ' . $request->get('date_closed_to_time')));
        $item->show_from = empty($request->get('date_show_from_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_show_from_day') . ' ' . $request->get('date_show_from_time')));
        $item->show_to = empty($request->get('date_show_to_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_show_to_day') . ' ' . $request->get('date_show_to_time')));
        $item->reason = $request->get('reason');

        $item->save();

        return redirect()->route('admin.motorstudio_deadlines.index');
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
        $item = MotorstudioDeadline::findOrFail($id);
        return view('admin.motorstudio_deadlines.edit', [
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
        $item = MotorstudioDeadline::findOrFail($id);

        $item->closed_from = empty($request->get('date_closed_from_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_closed_from_day') . ' ' . $request->get('date_closed_from_time')));
        $item->closed_to = empty($request->get('date_closed_to_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_closed_to_day') . ' ' . $request->get('date_closed_to_time')));
        $item->show_from = empty($request->get('date_show_from_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_show_from_day') . ' ' . $request->get('date_show_from_time')));
        $item->show_to = empty($request->get('date_show_to_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_show_to_day') . ' ' . $request->get('date_show_to_time')));
        $item->reason = $request->get('reason');

        $item->save();

        return redirect()->route('admin.motorstudio_deadlines.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = MotorstudioDeadline::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
