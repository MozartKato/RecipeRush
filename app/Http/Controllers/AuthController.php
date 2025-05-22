<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function registerUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:500',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'profile_picture' => $request->file('profile_picture') ? $request->file('profile_picture')->store('profile_pictures') : null,
            'bio' => $request->bio,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();

            $abilities = [
                'admin' => ['*'],
                'user' => ['view', 'create', 'update', 'delete'],
            ];

            $token = $user->createToken($user->role.'-token', $abilities[$user->role]);

            return response()->json(['message' => 'Login successful', 'token' => $token->plainTextToken], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function registerAdmin(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:500',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'profile_picture' => $request->file('profile_picture') ? $request->file('profile_picture')->store('profile_pictures') : null,
            'bio' => $request->bio,
            'role' => 'admin',
            'status' => 1,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Admin registered successfully'], 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout successful'], 200);
    }
}
