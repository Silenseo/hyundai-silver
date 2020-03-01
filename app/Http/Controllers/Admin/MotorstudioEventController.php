<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\MotorstudioEvent;

class MotorstudioEventController extends Controller
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
        $items = new MotorstudioEvent;
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

        return view('admin.motorstudio_events.index', [
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
        $item = new MotorstudioEvent();
        return view('admin.motorstudio_events.create', [
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
        $item = new MotorstudioEvent();

        $item->name = $request->get('name');
        $item->name_en = $request->get('name_en');
        $item->calendar_name = $request->get('calendar_name');
        $item->calendar_name_en = $request->get('calendar_name_en');
        $item->date_start = strtotime($request->get('date_start_day') . ' ' . $request->get('date_start_time'));
        $item->date_end = strtotime($request->get('date_end_day') . ' ' . $request->get('date_end_time'));
        $item->text = $request->get('text');
        $item->text_en = $request->get('text_en');
        $item->max_reg = is_numeric($request->get('max_reg')) && $request->get('max_reg') > 0 ? $request->get('max_reg') : 0;
        $item->is_promo = (bool)$request->get('is_promo');
        $item->available = (bool)$request->get('available');
        $item->check_registrations = (bool)$request->get('check_registrations');
        $item->repair = (bool)$request->get('repair');
        $item->visible = (bool)$request->get('visible');

        if(null !== $request->get('is_promo') && $request->get('is_promo') == 1) {
            $events = MotorstudioEvent::where('is_promo', 1)->get();
            foreach($events as $event) {
                $event->is_promo = 0;
                $event->save();
            }
        }


        if ($request->hasFile('preview_picture')) {
            $image = $request->file('preview_picture');
            $filename = time() . '_preview.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/motorstudio_events', $filename);
            $item->preview_picture = $filename;
        }

        if ($request->hasFile('detail_picture')) {
            $image = $request->file('detail_picture');
            $filename = time() . '_detail.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/motorstudio_events', $filename);
            $item->detail_picture = $filename;
        }

        if ($request->hasFile('mobile_picture')) {
            $image = $request->file('mobile_picture');
            $filename = time() . '_mobile.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/motorstudio_events', $filename);
            $item->mobile_picture = $filename;
        }

        $item->save();

        return redirect()->route('admin.motorstudio_events.index');
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
        $item = MotorstudioEvent::findOrFail($id);
        return view('admin.motorstudio_events.edit', [
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
        $item = MotorstudioEvent::findOrFail($id);

        $item->name = $request->get('name');
        $item->name_en = $request->get('name_en');
        $item->calendar_name = $request->get('calendar_name');
        $item->calendar_name_en = $request->get('calendar_name_en');
        $item->date_start = strtotime($request->get('date_start_day') . ' ' . $request->get('date_start_time'));
        $item->date_end = strtotime($request->get('date_end_day') . ' ' . $request->get('date_end_time'));
        $item->text = $request->get('text');
        $item->text_en = $request->get('text_en');
        $item->max_reg = is_numeric($request->get('max_reg')) && $request->get('max_reg') > 0 ? $request->get('max_reg') : 0;
        $item->is_promo = (bool)$request->get('is_promo');
        $item->available = (bool)$request->get('available');
        $item->check_registrations = (bool)$request->get('check_registrations');
        $item->repair = (bool)$request->get('repair');
        $item->visible = (bool)$request->get('visible');

        if(null !== $request->get('is_promo') && $request->get('is_promo') == 1) {
            $events = MotorstudioEvent::where('is_promo', 1)->get();
            foreach($events as $event) {
                $event->is_promo = 0;
                $event->save();
            }
        }


        if ($request->hasFile('preview_picture')) {
            $oldFile = $item->preview_picture;
            $image = $request->file('preview_picture');
            $filename = time() . '_preview.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/motorstudio_events', $filename);
            $item->preview_picture = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('motorstudio_events/' . $oldFile);
        }

        if ($request->hasFile('detail_picture')) {
            $oldFile = $item->detail_picture;
            $image = $request->file('detail_picture');
            $filename = time() . '_detail.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/motorstudio_events', $filename);
            $item->detail_picture = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('motorstudio_events/' . $oldFile);
        }

        if ($request->hasFile('mobile_picture')) {
            $oldFile = $item->mobile_picture;
            $image = $request->file('mobile_picture');
            $filename = time() . '_mobile.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/motorstudio_events', $filename);
            $item->mobile_picture = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('motorstudio_events/' . $oldFile);
        }

        $item->save();

        return redirect()->route('admin.motorstudio_events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = MotorstudioEvent::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
