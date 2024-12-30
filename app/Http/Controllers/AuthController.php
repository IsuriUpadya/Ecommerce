<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Ecommerce_User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');  // Ensure this view exists
    }

    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');  // Ensure this view exists
    }

    // Show the registration form
    public function showAdminRegistrationForm()
    {
        return view('auth.admin-register');  // Ensure this view exists
    }

    public function register(UserRegisterRequest $request)
    {
        // Validate the request and store the result in $validated
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:ecommerce_users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        // Create a new user in the ecommerce_users table
        $user = Ecommerce_User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        // If the role is admin, also add the user to the admins table
        if ($validated['role'] === 'admin') {
            $token = Admin::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

            $token = auth('api')->login($user);
    
            return $this->respondWithToken($token);
        }
    
        $token = auth('api')->login($user);
    
        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}