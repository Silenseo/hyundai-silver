<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\Car;
use App\SpecialOffer;
use App\SpecialOfferLabel;
use Illuminate\Support\Facades\Storage;

class SpecialOfferController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:special_offers_admin_main');
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
        $items = new SpecialOffer;
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

        return view('admin.special_offers.index', [
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
        $item = new SpecialOffer();
        $cars = Car::orderBy('name')->get();
        $labels = SpecialOfferLabel::orderBy('name')->get()->pluck('name', 'id');;
        return view('admin.special_offers.create', [
            'item' => $item,
            'cars' => $cars,
            'labels' => $labels,
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
        $item = new SpecialOffer();

        $item->name = $request->get('name');
        $item->url = $request->get('url');
        $item->type = $request->get('type');
        $item->label_id = $request->get('label_id');
        $item->text = $request->get('text');
        $item->banner_title = $request->get('banner_title');
        $item->banner_subtitle = $request->get('banner_subtitle');
        $item->show_header = (bool)$request->get('show_header');
        $item->blue_show = (bool)$request->get('blue_show');
        $item->blue_row1_type = $request->get('blue_row1_type') > 0 ? $request->get('blue_row1_type') : 0;
        $item->blue_row2_type = $request->get('blue_row2_type') > 0 ? $request->get('blue_row2_type') : 0;
        $item->blue_row3_type = $request->get('blue_row3_type') > 0 ? $request->get('blue_row3_type') : 0;
        $item->blue_row1_text = $request->get('blue_row1_text');
        $item->blue_row2_text = $request->get('blue_row2_text');
        $item->blue_row3_text = $request->get('blue_row3_text');
        $item->disclaimer = $request->get('disclaimer');
        $item->button_type = $request->get('button_type') > 0 ? $request->get('button_type') : 0;
        $item->is_active = (bool)$request->get('is_active');
        $item->sort = $request->get('sort');
        $item->active_from = empty($request->get('date_active_from_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_active_from_day') . ' ' . $request->get('date_active_from_time')));
        $item->active_to = empty($request->get('date_active_to_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_active_to_day') . ' ' . $request->get('date_active_to_time')));
        $item->show_quick_buttons = (bool)$request->get('show_quick_buttons');

        if ($request->hasFile('image_preview')) {
            $image = $request->file('image_preview');
            $filename = 'preview_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/special_offers', $filename);
            $item->image_preview = $filename;
        }

        if ($request->hasFile('image_world')) {
            $image = $request->file('image_world');
            $filename = 'world_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/special_offers', $filename);
            $item->image_world = $filename;
        }

        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $filename = 'banner_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/special_offers', $filename);
            $item->banner = $filename;
        }

        if ($request->hasFile('banner_mobile')) {
            $image = $request->file('banner_mobile');
            $filename = 'bannerm_' . time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/special_offers', $filename);
            $item->banner_mobile = $filename;
        }

        if ($request->hasFile('video_desktop')) {
            $file = $request->file('video_desktop');
            $filename = 'vd_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/special_offers', $filename);
            $item->video_desktop = $filename;
        }

        if ($request->hasFile('video_mobile')) {
            $file = $request->file('video_mobile');
            $filename = 'vm_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/special_offers', $filename);
            $item->video_mobile = $filename;
        }

        $item->save();

        $item->cars()->sync($request->get('car_selected'));

        return redirect()->route('admin.special_offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = SpecialOffer::findOrFail($id);
        $cars = Car::orderBy('name')->get();
        $labels = SpecialOfferLabel::orderBy('name')->get()->pluck('name', 'id');
        $cars_selected = $item->cars->keyBy('id');
        return view('admin.special_offers.edit', [
            'item' => $item,
            'cars' => $cars,
            'labels' => $labels,
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
        $item = SpecialOffer::findOrFail($id);

        $item->name = $request->get('name');
        $item->url = $request->get('url');
        $item->type = $request->get('type');
        $item->label_id = $request->get('label_id');
        $item->text = $request->get('text');
        $item->banner_title = $request->get('banner_title');
        $item->banner_subtitle = $request->get('banner_subtitle');
        $item->show_header = (bool)$request->get('show_header');
        $item->blue_show = (bool)$request->get('blue_show');
        $item->blue_row1_type = $request->get('blue_row1_type');
        $item->blue_row2_type = $request->get('blue_row2_type');
        $item->blue_row3_type = $request->get('blue_row3_type');
        $item->blue_row1_text = $request->get('blue_row1_text');
        $item->blue_row2_text = $request->get('blue_row2_text');
        $item->blue_row3_text = $request->get('blue_row3_text');
        $item->disclaimer = $request->get('disclaimer');
        $item->button_type = $request->get('button_type');
        $item->is_active = (bool)$request->get('is_active');
        $item->sort = $request->get('sort');
        $item->active_from = empty($request->get('date_active_from_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_active_from_day') . ' ' . $request->get('date_active_from_time')));
        $item->active_to = empty($request->get('date_active_to_day')) ? null : date('Y-m-d H:i:s', strtotime($request->get('date_active_to_day') . ' ' . $request->get('date_active_to_time')));
        $item->show_quick_buttons = (bool)$request->get('show_quick_buttons');

        if ($request->hasFile('image_preview')) {
            $oldFile = $item->image_preview;
            $image = $request->file('image_preview');
            $filename = 'preview_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/special_offers', $filename);
            $item->image_preview = $filename;
            Storage::disk('public')->delete('special_offers/' . $oldFile);
        }

        if ($request->hasFile('image_world')) {
            $oldFile = $item->image_world;
            $image = $request->file('image_world');
            $filename = 'world_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/special_offers', $filename);
            $item->image_world = $filename;
            Storage::disk('public')->delete('special_offers/' . $oldFile);
        }

        if ($request->hasFile('banner')) {
            $oldFile = $item->banner;
            $image = $request->file('banner');
            $filename = 'banner_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/special_offers', $filename);
            $item->banner = $filename;
            Storage::disk('public')->delete('special_offers/' . $oldFile);
        }

        if ($request->hasFile('banner_mobile')) {
            $oldFile = $item->banner_mobile;
            $image = $request->file('banner_mobile');
            $filename = 'bannerm_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/special_offers', $filename);
            $item->banner_mobile = $filename;
            Storage::disk('public')->delete('special_offers/' . $oldFile);
        }

        if ($request->hasFile('video_desktop')) {
            $oldFile = $item->video_desktop;
            $file = $request->file('video_desktop');
            $filename = 'vd_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/special_offers', $filename);
            $item->video_desktop = $filename;
            Storage::disk('public')->delete('special_offers/' . $oldFile);
        }

        if ($request->hasFile('video_mobile')) {
            $oldFile = $item->video_mobile;
            $file = $request->file('video_mobile');
            $filename = 'vm_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/special_offers', $filename);
            $item->video_mobile = $filename;
            Storage::disk('public')->delete('special_offers/' . $oldFile);
        }

        $item->save();

        $item->cars()->sync($request->get('car_selected'));
        return redirect()->route('admin.special_offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SpecialOffer::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
