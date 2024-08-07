<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
