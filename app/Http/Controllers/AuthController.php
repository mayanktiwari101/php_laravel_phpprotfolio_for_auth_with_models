<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;


class AuthController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            [
                "success" => true,
                "message" => "index fetched successfully",
            ],
            200
        );
    }

    public function store(Request $request) 
        {

            $fields = [
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "password" => $request->input('password')
            ];

           $user = UserModel::create(
                [
                    "name" => $fields['name'],
                    "email" => $fields["email"],
                    "password" => Hash::make($fields['password'])
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(
                [
                    "success" => true,
                    "message" => "User installed successfully",
                    "data" => $user,
                    "token" => $token
                ],
                200
            );
        }

        public function login(Request $request)
        {
            $fields = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];

            $user = UserModel::where('email', $fields['email'])->first();

            if(!$user || !Hash::check($fields['password'], $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 500);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(
                [
                    "message" => 'Logged in successfully',
                    "user" => $user,
                    "token" => $token
                ], 200
            );

        }
}