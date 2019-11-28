<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\CsvFile;

class CsvFileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $items = new CsvFile;
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

        return view('admin.csvfile.index', [
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
        $item = new CsvFile();
        return view('admin.csvfile.create', [
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
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:csv_files,code',
            'file' => 'required|file',
        ]);

        $item = new CsvFile();

        $item->name = $request->get('name');
        $item->code = $request->get('code');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/csvfiles', $filename);
            $item->file = $filename;
        }

        $item->save();

        return redirect()->route('admin.csvfile.index');
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
        $item = CsvFile::findOrFail($id);
        return view('admin.csvfile.edit', [
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
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => [
                'required',
                \Illuminate\Validation\Rule::unique('csv_files')->ignore($id),
            ],
        ]);

        $item = CsvFile::findOrFail($id);

        $item->name = $request->get('name');
        $item->code = $request->get('code');

        if ($request->hasFile('file')) {
            $oldFile = $item->file;
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/csvfiles', $filename);
            $item->file = $filename;

            Storage::disk('public')->delete('csvfiles/' . $oldFile);
        }

        $item->save();

        return redirect()->route('admin.csvfile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CsvFile::findOrFail($id);
        $oldFile = $item->file;
        Storage::disk('public')->delete('csvfiles/' . $oldFile);
        $item->delete();
        return redirect()->back();
    }
}
