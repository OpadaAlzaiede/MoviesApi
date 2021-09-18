<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class UserAuthController extends Controller
{
    public function register(RegisterRequest $request) {

        $user = User::create($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        
        $token = $user->createToken('auth token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(LoginRequest $request) {

        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        $user = auth()->user();
        $token = $user->createToken('auth token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout() {

        auth()->user()->tokens()->delete();
        
        return response()->json([
            'message' => 'logged out'
        ], 200);
    }
}
