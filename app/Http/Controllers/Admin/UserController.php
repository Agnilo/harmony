<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $user)
    // {

    //     if (!$user->can('edit-users')) {
    //         return redirect()->route('admin.users.index');
    //     }

    //     $roles = Role::all();
    //     return view('admin.users.edit', compact('user', 'roles'));
    // }

    public function edit(User $user)
    {
        if (auth()->user()->can('edit-users')) {
            $roles = Role::all();
            return view('admin.users.edit', compact('user', 'roles'));
        } else{
        // if ($user->hasRole('Admin') || $user->hasRole('SuperUser')) {
        //     $roles = Role::all();
        //     return view('admin.users.edit', compact('user', 'roles'));   
        // }

        return redirect()->route('admin.users.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->email = $request->email;

        //$user->syncRoles($request->roles);

        $validateRoleIds = $request->roles;
        $roles = Role::whereIn('id', $validateRoleIds)->get();
        $user->syncRoles($roles);

        if ($user->save()) {
            $request->session()->flash('success', 'Vartotojas ' . $user->first_name . ' buvo atnaujintas');
        } else {
            $request->session()->flash('warning', 'Iškilo problema atnaujinant vartotoją');
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!$user->can('delete-users')) {
            return redirect()->route('admin.users.index');
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }
    
}