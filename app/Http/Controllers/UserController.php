<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function register_user(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email',
            'image' => '',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'image' => $validatedData['image'],
            'password' => bcrypt($validatedData['password'])
        ]);
        $token = $user->createToken("TOKENPLAINTEXT")->plainTextToken;
        $user->api_token = $token;
        $user->save();
        return response()->json(["success" => true, "data" => $user, "message" => "User register successfully"]);
    }
    public function login_user(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        $user = User::where('email', $validatedData['email'])->first();
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json(["success" => false, "data" => null, 'message' => 'Invalid phone number or password'], 401);
        }
        return response()->json(["success" => true, "data" => $user, "message" => "User login successfully"]);
    }
}