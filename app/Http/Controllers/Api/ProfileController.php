<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json([
            'status' => true,
            'message' => 'User Profile',
            // 'data' => auth()->user(),
            'data' => new ProfileResource(auth()->user()),
        ]);
    }

    public function edit()
    {
        return response()->json([
            'status' => true,
            'message' => 'User Profile',
            // 'data' => auth()->user(),
            'data' => new ProfileResource(auth()->user())
        ]);
    }
}
