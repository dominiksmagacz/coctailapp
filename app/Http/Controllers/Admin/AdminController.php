<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $permissions = Permission::all()->toQuery()->paginate(20);;
        // if(count($permissions)>0)
        //     $permissions->toQuery()->paginate(5);
        $roles = Role::all()->toQuery()->paginate(20);
        $users = User::get()->toQuery()->paginate(10);


        return view('admins.index', compact('users', 'roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
            
        ]);
    
        return redirect()->route('admins.index')->with('message', 'Konto zostało utworzone.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $user = User::find($id);

        return view('admins.show', compact('user', 'roles', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $users, $id)
    {
        $roles = Role::all();
        $selectedroles = [];
        foreach($users->roles as $role){
            $selectedrole[] = $role->id;
        }
        return view('admins.edit', [
            'user' => User::where('id', $id)->first(),
            'roles' => $roles,
            'selectedroles' => $selectedroles
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        User::where('id', $id)->update($request->except(['_token', '_method']));

        // $validated = $request->validateWithBag('password');

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        //return back()->with('status', 'password-updated');

        return redirect(route('admins.index'))->with('message', 'Konto zostało zmodyfikowane.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect(route('admins.index'))->with('message', 'Konto zostało usunięte.');
   
    }
}