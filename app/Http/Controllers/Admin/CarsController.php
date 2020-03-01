<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Car;

class CarsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:cars_admin_main');
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
        $items = new Car;
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

        return view('admin.cars.index', ['cars' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $car = new Car([
            'name' => $request->get('name'),
            'name_menu_rus' => $request->get('name_menu_rus'),
            'name_menu_en' => $request->get('name_menu_en'),
            'id_text' => $request->get('id_text'),
            'price_min' => $request->get('price_min'),
            'siebel_code' => $request->get('siebel_code'),
            'menu_row' => $request->get('menu_row'),
            'menu_column' => $request->get('menu_column'),
            'conf_id' => $request->get('conf_id'),
            'image' => '',
            'img_left_mp' => '',
            'img_right_mp' => '',
            'img_beauty_mp' => '',
            'ga_modelcode' => $request->get('id_text'),
            'visible' => (bool)$request->get('visible'),
            'is_promo' => (bool)$request->get('is_promo'),
            'conf_car_id' => 0,
            'is_old_model' => (bool)$request->get('is_old_model'),
            'tradein' => $request->get('tradein'),
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/cars', $filename);

            $car->image = $filename;
        }

        if ($request->hasFile('image_left_mp')) {
            $image = $request->file('img_left_mp');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/cars', $filename);

            $car->img_left_mp = $filename;

        }

        if ($request->hasFile('image_right_mp')) {
            $image = $request->file('img_right_mp');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/cars', $filename);

            $car->img_right_mp = $filename;
        }

        if ($request->hasFile('image_beauty_mp')) {
            $image = $request->file('img_beauty_mp');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/cars', $filename);

            $car->img_beauty_mp = $filename;
        }

        $car->save();
        return redirect('admin/cars')->with('Добавлено', 'Автомобиль успешно добавлен');
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);

        return view('admin.cars.edit', compact('car'));
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
        $car = Car::find($id);
        $car->name = $request->get('name');
        $car->name_menu_rus = $request->get('name_menu_rus');
        $car->name_menu_en = $request->get('name_menu_en');
        $car->id_text = $request->get('id_text');
        $car->price_min = $request->get('price_min');
        $car->siebel_code = $request->get('siebel_code');
        $car->menu_row = $request->get('menu_row');
        $car->menu_column = $request->get('menu_column');
        $car->conf_id = $request->get('conf_id');

        $car->visible = (bool)$request->get('visible');
        $car->is_promo = (bool)$request->get('is_promo');
        $car->is_old_model = (bool)$request->get('is_old_model');
        $car->tradein = $request->get('tradein');

        if ($request->hasFile('image')) {
            $oldFile = $car->image;

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/cars', $filename);

            $car->image = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('cars/' . $oldFile);
        }

        if ($request->hasFile('image_left_mp')) {
            $oldFile = $car->img_left_mp;

            $image = $request->file('image_left_mp');
            $filename = time() . '_left.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/cars', $filename);

            $car->img_left_mp = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('cars/' . $oldFile);
        }

        if ($request->hasFile('image_right_mp')) {
            $oldFile = $car->img_right_mp;

            $image = $request->file('image_right_mp');
            $filename = time() . '_right.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/cars', $filename);

            $car->img_right_mp = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('cars/' . $oldFile);
        }

        if ($request->hasFile('image_beauty_mp')) {
            $oldFile = $car->img_beauty_mp;

            $image = $request->file('image_beauty_mp');
            $filename = time() . '_beauty.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('public/cars', $filename);

            $car->img_beauty_mp = $filename;

            /* TODO - удалить старую пикчу */
            Storage::disk('public')->delete('cars/' . $oldFile);
        }

        $car->save();

        return redirect('admin/cars')->with('Успех', 'Автомобиль отредактирован');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Car::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
