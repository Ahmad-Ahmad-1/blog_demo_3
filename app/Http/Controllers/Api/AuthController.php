<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $user = Validator::make(
                $request->all(),
                [
                    'name' => ['required'],
                    'email' => ['required', 'email', 'unique:users,email'],
                    'password' => [
                        'required',
                        'confirmed',
                        // Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised(),
                    ],
                ],
            );

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
                    // We might not need this because this is register:
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
                // the parameter for createToken is token name
                // and then you take the plain text token out of all the returned data.
                'token' => $user->createToken('API Token')->plainTextToken,
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

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'user logged out',
            'data' => [],
        ]);
    }
}
