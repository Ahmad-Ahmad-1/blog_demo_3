<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json([
            'status' => true,
            'message' => 'User Profile',
            'data' => auth()->user(),
        ]);
    }

    public function edit()
    {
        return response()->json([
            'status' => true,
            'message' => 'User Profile',
            'data' => auth()->user(),
        ]);
    }
}
