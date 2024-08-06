<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return response()->json([
            'status' => true,
            'message' => 'User Profile',
            'data' => auth()->user(),
        ]);
    }
}
