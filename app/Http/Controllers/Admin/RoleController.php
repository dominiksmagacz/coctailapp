<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admins.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        Role::create([
            'name' => $request->name
        ]);

        return redirect()->route('admins.index')->with('message', 'Rola została utworzona.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('admins.roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $role = Role::find($id);
        // dd($id);
        $permissions = Permission::all();

        return view('admins.roles.edit', [
            'role' => Role::where('id', $id)->first(),
            'permissions' => $permissions
        ]);

        // return view('admins.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        Role::where('id', $id)->update($request->except(['_token', '_method']));

        return redirect(route('admins.index'))->with('message', 'Rola została zmodyfikowana.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect(route('admins.index'))->with('message', 'Rola została usunięta.');
    }

    
    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return redirect(route('admins.index'))->with('message', 'Rola ' . $role->name . ' posiada juz takie uprawnienie.');
        }
        $role->givePermissionTo($request->permission);
        return redirect(route('admins.index'))->with('message', 'Uprawnienie zostało dodane do roli ' . $role->name);
    }


    public function giveRole(Request $request, Role $role, User $user)
    {
        // dd($user);
        if ($user->hasRole($request->role)) {
            return redirect(route('admins.index'))->with('message', 'Uzytkownik ' . $user->name . ' juz posiada taką rolę');
        }
        $user->assignRole($request->role);
        return redirect(route('admins.index'))->with('message', 'Rola została dodana do uzytkownika ' . $user->name);
    }

    public function removeRole(Request $request, Role $role, User $user)
    {
        // dd($request);   
        
        if ($user->hasRole($request->role)) {
            $user->removeRole($request->role);
            return redirect(route('admins.index'))->with('message', 'Rola została odjęta uzytkownikowi.');
        }
        else
            return redirect(route('admins.index'))->with('message', 'Uzytkownik nie posiada takiej roli.');
        
    }

    public function removePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            $role->revokePermissionTo($request->permission);
            return redirect(route('admins.index'))->with('message', 'Uprawnienie zostało usunięte z roli: ' . $role->name);
        }
        else
        return redirect(route('admins.index'))->with('message', 'Rola ' . $role->name . ' nie posiada takiego uprawnienia.');
    }
}
