<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\News;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:news_admin_main');
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
        $items = new News;
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($items->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
        }
        else {
            $items->orderBy('id', 'desc');
        }
        $items = $items->paginate(20);

        return view('admin.news.index', [
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
        $item = new News();
        return view('admin.news.create', [
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
        $item = new News();

        $item->title = $request->get('title');
        $item->url = $request->get('url');        
        $item->date = strtotime($request->get('date'));

        $item->preview_text = $request->get('preview_text');
        $item->text = $request->get('text');

        $item->meta_title = $request->get('meta_title');
        $item->meta_keywords = $request->get('meta_keywords');
        $item->meta_description = $request->get('meta_description');

        $item->visible = (bool)$request->get('visible');
        
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/news', $filename);
            
            $item->img = $filename;
        }

        $item->save();

        return redirect()->route('admin.news.index');
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
        $item = News::findOrFail($id);
        return view('admin.news.edit', [
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
        $item = News::findOrFail($id);
        return view('admin.news.edit', [
            'item' => $item,
        ]);
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
        $item = News::findOrFail($id);
        $item->title = $request->get('title');
        $item->url = $request->get('url');        
        $item->date = strtotime($request->get('date'));

        $item->preview_text = $request->get('preview_text');
        $item->text = $request->get('text');

        $item->meta_title = $request->get('meta_title');
        $item->meta_keywords = $request->get('meta_keywords');
        $item->meta_description = $request->get('meta_description');

        $item->visible = (bool)$request->get('visible');
        
        if ($request->hasFile('img')) {
            $oldFile = $item->img;

            $image = $request->file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/news', $filename);
            
            $item->img = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('news/' . $oldFile);
        }

        $item->save();

        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = News::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
