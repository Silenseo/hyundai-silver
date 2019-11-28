<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\UserPermission;
use App\UserRole;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:users_admin_main');
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
        $items = new User;
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

        return view('admin.users.index', ['users' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = UserRole::all();
        $permissions = UserPermission::orderBy('name')->get();

        return view('admin.users.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')) // Перепилить этот момент
        ]);
        $user->save();

        $user->roles()->sync($request->get('roles_selected'));

        $user->syncPermissions($request->get('permissions_selected'));

        return redirect('admin/users')->with('success', 'Пользователь успешно добавлен');
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
        $user = User::find($id);
        $roles = UserRole::all();
        $roles_selected = $user->roles->keyBy('id');
        $permissions = UserPermission::orderBy('name')->get();
        $permissions_selected = $user->permissions->keyBy('id');

        return view('admin.users.edit', compact('user', 'roles', 'roles_selected', 'permissions', 'permissions_selected'));
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
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if(strlen( $request->get('password') ) > 0)
            $user->password = Hash::make($request->get('password')); // Заменить
                
        $user->save();

        $user->roles()->sync($request->get('roles_selected'));

        $user->syncPermissions($request->get('permissions_selected'));

        return redirect('admin/users')->with('success', 'Пользователь отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == '1') {
            return redirect()->back();
        }
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
