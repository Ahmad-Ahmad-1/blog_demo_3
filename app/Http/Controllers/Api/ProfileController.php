<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PasswordUpdateRequest;
use App\Http\Requests\Api\Profile\ProfileUpdateRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return response()->json([
            'status' => true,
            'message' => 'User Profile',
            'data' => new ProfileResource(auth()->user())
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->update([
            'name' => $request->validated('name'),
        ]);

        return response()->json([
            'user' => new ProfileResource(auth()->user()),
        ]);
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->validated('new_password'))
        ]);

        return response()->json([
            'message' => 'password updated successfully'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'user account has been deleted successfully'
        ]);
    }
}
