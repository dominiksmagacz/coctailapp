<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
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
        return view('admins.roles.show', compact('role'));
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
        // dd($request->permission);
        if ($role->hasPermissionTo($request->permission)) {
            // return back()->with('message', 'Uprawnienie jest juz dodane.');
        redirect(route('admins.index'))->with('message', 'Rola została zmodyfikowana.');
        }

        $role->givePermissionTo($request->permission);
        // return back()->with('message', 'Dodano uprawnienie.');
        return redirect(route('admins.index'))->with('message', 'Rola została zmodyfikowana.');
    }
}
