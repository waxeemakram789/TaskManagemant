<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json(['message' => 'User registered successfully.'], 201);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()],500); 
        } 
    }

    public function login(Request $request)
    {
        
        $credentials =  Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($credentials->fails()) {
            return response()->json(['errors' => $credentials->errors()], 422);
        }

        if (!auth()->attempt($request->all())) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'Logged in successfully.'], 200);
    }
}
