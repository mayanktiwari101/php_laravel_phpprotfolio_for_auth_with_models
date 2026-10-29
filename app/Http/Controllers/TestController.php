<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controllers;
use Illuminate\Support\Facades\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'This is working fine',
            'data' => $request
        ]);
    }

    
}

