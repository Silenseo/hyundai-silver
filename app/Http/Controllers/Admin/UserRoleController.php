<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\UserPermission;
use App\UserRole;

class UserRoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:user_roles_admin_main');
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
        $items = new UserRole;
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($items->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
        }
        $items = $items->get();
        return view('admin.user_roles.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new UserRole();
        $permissions = UserPermission::orderBy('name')->get();
        return view('admin.user_roles.create', [
            'item' => $item,
            'permissions' => $permissions,
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
        if(null !== UserRole::where('code', $request->get('code'))->first()) {
            return redirect()->back()->with('error', 'Группа с таким кодом уже есть');
        }

        $item = new UserRole([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
        ]);
        $item->save();

        $item->syncPermissions($request->get('permissions_selected'));

        return redirect()->route('admin.user_roles.index');
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
        $item = UserRole::findOrFail($id);
        $permissions = UserPermission::orderBy('name')->get();
        $permissions_selected = $item->permissions->keyBy('id');

        return view('admin.user_roles.edit', compact('item', 'permissions', 'permissions_selected'));
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
        if(null !== UserRole::where('code', $request->get('code'))->where('id', '!=', $id)->first()) {
            return redirect()->back()->with('error', 'Группа с таким кодом уже есть');
        }

        $item = UserRole::findOrFail($id);
        $item->name = $request->get('name');
        $item->code = $request->get('code');
        $item->save();

        $item->syncPermissions($request->get('permissions_selected'));

        return redirect()->route('admin.user_roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = UserRole::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
