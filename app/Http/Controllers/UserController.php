<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function getUsers() 
    {
        $users = User::get();

        return response()->json($users, 200);
    }

    public function getUser(User $user) 
    {
        return response()->json($user, 200);
    }

    public function getUserPurchases(User $user) 
    {
        $user->load('purchases');

        return response()->json($user, 200);
    }

    public function roles(User $user) 
    {
        $roles = Role::all();
        return response()->json($roles, 200);
    }

    public function createUser(Request $request) 
    {
        $user = new User($request->all());
        $user->save();

        return response()->json($user, 201);
    }

    public function updateUser(Request $request, User $user) 
    {
        //$user->roles()->sync($request->roles);
        $user->update($request->all());

        return response()->noContent();
    }

    public function deleteUser(User $user) 
    {
        $user->delete();

        return response()->noContent();
    }
}
