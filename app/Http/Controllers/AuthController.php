<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registration(Request $request)
    {
        //validation
        $data = $request->validate(
            [
                "name" => "required|string",
                "email" => "required|string|unique:users,email",
                "password" => "required|string|min:6|confirmed",
            ]
        );
        //create_user
        $user = User::create(
            [
                "name" => $data["name"],
                "email" => $data["email"],
                "password" => bcrypt($data["password"]),
            ]
        );
        //token_generate
        $token = $user->createToken('ntw_admin_token')->plainTextToken;

        $response = [
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
            ],
            "token" => $token
        ];

        return response($response, 201);
    }
    public function login(Request $request)
    {
        //validation
        $data = $request->validate(
            [
                "email" => "required|string",
                "password" => "required|string",
            ]
        );
        //checkEmail
        $user = User::where("email", $data['email'])->first();

        //checkPassword
        if (!$user || !Hash::check($data["password"], $user->password)) {
            return response([
                "message" => "Bad Credantials"
            ], 401);
        }
        //token_generate
        $token = $user->createToken('ntw_admin_token')->plainTextToken;
        $response = [
            "user" => $user,
            "token" => $token
        ];
        return response($response, 200);
    }
    public function logout()
    {
        auth()->user()->token()->delete();
        return [
            "message" => "Admin Logged Out Successfully"
        ];
    }
}
