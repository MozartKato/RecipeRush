<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getInfoUser()
    {
        $user = auth()->user();
        return response()->json($user, 200);
    }

    public function updateUser(Request $request){
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|max:255|unique:users,username,' . auth()->id(),
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . auth()->id(),
            'profile_picture' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'sometimes|nullable|string|max:500',
        ]);

        $user = auth()->user();
        $user->update($request->all());

        return response()->json(['message' => 'User updated successfully'], 200);
    }
}   
