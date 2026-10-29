<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            [
                "success" => true,
                "message" => "This is a message from the user Controller",
            ],
            200
        );
    }


    public function show(Request $request)
    {

        $results = UserModel::all();

        return response()->json(
            [
                "success" => true,
                "message" => "User fetched successfully",
                "results" => $results,
            ],
            200
        );
    }
}