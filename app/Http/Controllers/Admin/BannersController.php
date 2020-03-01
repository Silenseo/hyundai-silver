<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Banner;

class BannersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:banners_admin_main');
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
        $items = new Banner;
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

        return view('admin.banners.index', [
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
        $item = new Banner();
        return view('admin.banners.create', [
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
        $item = new Banner();

        $item->name = $request->get('name');
        $item->title = $request->get('title');
        $item->subtitle = $request->get('subtitle');
        $item->image_text = '';
        $item->blue_show = (bool)$request->get('blue_show');
        $item->blue_row1 = $request->get('blue_row1');
        $item->blue_row2 = $request->get('blue_row2');
        $item->blue_row3 = $request->get('blue_row3');
        $item->font_color = $request->get('font_color');
        $item->row1_type = $request->get('row1_type') > 0 ? $request->get('row1_type') : 0;
        $item->row2_type = $request->get('row2_type') > 0 ? $request->get('row2_type') : 0;
        $item->row3_type = $request->get('row3_type') > 0 ? $request->get('row3_type') : 0;
        $item->order = $request->get('order');
        $item->visible = (bool)$request->get('visible');
        $item->link = $request->get('link');
        $item->target = (bool)$request->get('target');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/banners', $filename);
            $item->image = $filename;
        }

        if ($request->hasFile('image_mobile')) {
            $image = $request->file('image_mobile');
            $filename = time() . '_mob.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/banners', $filename);
            $item->image_mobile = $filename;
        }

        if ($request->hasFile('video_desktop')) {
            $file = $request->file('video_desktop');
            $filename = 'vd_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/banners', $filename);
            $item->video_desktop = $filename;
        }

        if ($request->hasFile('video_mobile')) {
            $file = $request->file('video_mobile');
            $filename = 'vm_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/banners', $filename);
            $item->video_mobile = $filename;
        }

        $item->save();

        return redirect()->route('admin.banners.index');
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
        $item = Banner::findOrFail($id);
        return view('admin.banners.edit', [
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
        $item = Banner::findOrFail($id);
        $item->name = $request->get('name');
        $item->title = $request->get('title');
        $item->subtitle = $request->get('subtitle');
        $item->image_text = '';
        $item->blue_show = (bool)$request->get('blue_show');
        $item->blue_row1 = $request->get('blue_row1');
        $item->blue_row2 = $request->get('blue_row2');
        $item->blue_row3 = $request->get('blue_row3');
        $item->font_color = $request->get('font_color');
        $item->row1_type = $request->get('row1_type');
        $item->row2_type = $request->get('row2_type');
        $item->row3_type = $request->get('row3_type');
        $item->order = $request->get('order');
        $item->visible = (bool)$request->get('visible');
        $item->link = $request->get('link');
        $item->target = (bool)$request->get('target');

        if ($request->hasFile('image')) {
            $oldFile = $item->image;
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/banners', $filename);
            $item->image = $filename;
            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('banners/' . $oldFile);
        }

        if ($request->hasFile('image_mobile')) {
            $oldFile = $item->image_mobile;
            $image = $request->file('image_mobile');
            $filename = time() . '_mob.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/banners', $filename);
            $item->image_mobile = $filename;
            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('banners/' . $oldFile);
        }

        if ($request->hasFile('video_desktop')) {
            $oldFile = $item->video_desktop;
            $file = $request->file('video_desktop');
            $filename = 'vd_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/banners', $filename);
            $item->video_desktop = $filename;
            Storage::disk('public')->delete('banners/' . $oldFile);
        }

        if ($request->hasFile('video_mobile')) {
            $oldFile = $item->video_mobile;
            $file = $request->file('video_mobile');
            $filename = 'vm_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/banners', $filename);
            $item->video_mobile = $filename;
            Storage::disk('public')->delete('banners/' . $oldFile);
        }

        $item->save();

        return redirect()->route('admin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Banner::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
