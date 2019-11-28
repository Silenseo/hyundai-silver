<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\StoragePhoto;

class StoragePhotosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:storage_photos_admin_main');
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
        $items = new StoragePhoto();
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

        return view('admin.storage_photos.index', [
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
        $item = new StoragePhoto();
        return view('admin.storage_photos.create', [
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
        $item = new StoragePhoto();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // $path = $image->storeAs('public/storage_photos', $filename);
            // $item->file = $filename;
            $imgExts = ['jpeg', 'jpg', 'png', 'gif'];
            if(!in_array($image->getClientOriginalExtension(), $imgExts))
            {
                return redirect()->back();
            }

            $newImg = \Image::make($image);
            if($newImg->width() > 1200) {
                $newImg->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $path = Storage::put('public/storage_photos/' . $filename, $newImg->encode());
            // $newImg->save('public/storage/');

            $item->file = $filename;
        }
        else {
            return redirect()->back();
        }

        $item->save();

        return redirect()->route('admin.storage_photos.index');
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
        $item = StoragePhoto::findOrFail($id);
        return view('admin.storage_photos.edit', [
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
        $item = StoragePhoto::findOrFail($id);

        if ($request->hasFile('file')) {
            $oldFile = $item->file;

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/storage_photos', $filename);

            $item->file = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('storage_photos/' . $oldFile);
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
        $item = StoragePhoto::findOrFail($id);
        $oldFile = $item->file;
        $item->delete();
        Storage::disk('public')->delete('storage_photos/' . $oldFile);
        return redirect()->back();
    }
}
