<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\DealerMenuCategory;
use App\DealerMenuPage;

class DealerMenuPagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:dealer_menu_admin_main');
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
        $items = new DealerMenuPage;
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($items->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
            else {
                if($sort_field == 'category__name') {
                    $items = $items->join('dealer_menu_categories', 'dealer_menu_pages.category_id', '=', 'dealer_menu_categories.id')
                        ->orderBy('dealer_menu_categories.name', $sort_order)
                        ->select('dealer_menu_pages.*');
                }
            }
        }
        $items = $items->paginate(20);

        return view('admin.dealer_menu_pages.index', [
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
        $item = new DealerMenuPage();
        $categories = DealerMenuCategory::orderBy('name')->get()->pluck('name', 'id');

        return view('admin.dealer_menu_pages.create', [
            'item' => $item,
            'categories' => $categories,
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
        $item = new DealerMenuPage();

        $item->name = $request->get('name');
        $item->sort = $request->get('sort');
        $item->active = (bool)$request->get('active');
        $item->category_id = $request->get('category_id');
        $item->url = $request->get('url');

        $item->save();

        return redirect()->route('admin.dealer_menu_pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DealerMenuPage::findOrFail($id);
        $categories = DealerMenuCategory::orderBy('name')->get()->pluck('name', 'id');

        return view('admin.dealer_menu_pages.edit', [
            'item' => $item,
            'categories' => $categories,
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
        $item = DealerMenuPage::findOrFail($id);

        $item->name = $request->get('name');
        $item->sort = $request->get('sort');
        $item->active = (bool)$request->get('active');
        $item->category_id = $request->get('category_id');
        $item->url = $request->get('url');

        $item->save();

        return redirect()->route('admin.dealer_menu_pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = DealerMenuPage::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
