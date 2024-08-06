<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Throwable;

// Authentication functions
class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $user = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8',
                    // '_token' => csrf_token()
                ]
            );

            // is it necessary here to return anything other than valdation errors
            // (which are gonna returned without any intervention from the developer).
            // if no, then the whole if condition here isn't necessary.

            if ($user->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $user->errors()
                    ],
                    // for validation error.
                    401
                );
            }

            $createdUser = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password
                ]
            );

            return response()->json(
                [
                    'status' => true,
                    'message' => 'user registered successfully',
                    // 'user data' => ['email' => $createdUser->email, 'password' => $createdUser->password]
                    // We might not need this:
                    'token' => $createdUser->createToken("API Token")->plainTextToken,
                ]
            );
        } catch (Throwable $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                // for Internal Server Error.
                500
            );
        }
    }

    public function login(Request $request)
    {
        try {
            $user = Validator::make(
                $request->only(['email', 'password']),
                [
                    'email' => 'required|email|exists:users,email',
                    'password' => 'required|min:8'
                ]
            );

            if ($user->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $user->errors()
                    ],
                    401
                );
            }

            // If the credentials match those of a user in the database, Auth::attempt will log in the user and return true.
            // Otherwise, it will return false.
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'the email and password does not match',
                    ],
                    401
                );
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'login success',
                'token' => $user->createToken('API Token')->plainTextToken,
                // 'token' => $user->createToken()
            ]);
        } catch (Throwable $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function profile()
    {
        return response()->json([
            'status' => true,
            'message' => 'User Profile',
            'data' => auth()->user(),
        ]);
    }

    // public function logout()
    // {
    //     auth()->user()->tokens()->delete();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'user logged out',
    //         'data' => [],
    //     ]);
    // }
}
