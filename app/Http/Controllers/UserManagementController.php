<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $users = User::whereNot('id', auth()->user()->id)->get();

        return view('users_management.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users_management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make('password')
        ]);

        $role = Role::findByName($request->type);
        $user->assignRole($role);

        return redirect()->route('user-management.index')->with('success', 'User created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();
        $user_role = isset($roles[0]) ? $roles[0] : '';
        
        return view('users_management.edit', compact('user', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $user = User::find($id);
        $user->firstname = $request->firstname;   
        $user->lastname = $request->lastname;   
        $user->email = $request->email;   
        $user->status = $request->status; 
        $user_role = $user->getRoleNames();
        $user->save();
        if (isset($user_role[0]) && $user_role[0] != $request->type) {
            $user->removeRole($user_role[0]);

            $role = Role::findByName($request->type);
            $user->assignRole($role);
        }
        
        return redirect()->route('user-management.index')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
