<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public function index()
    {
        $users = User::latest()->paginate(5);

        // return response()->json([
        //     'users' => $users
        // ]);

        // return view('users.index', ['users' => $users]);

        return response()->json([
            'users' => UserResource::collection($users),
            'current_page' => $users->currentPage()
        ]);
    }

    public function create()
    {
        // User will just login.
    }

    public function store()
    {
        // User will just login.
    }

    public function show(User $user)
    {
        // return response()->json([
        //     'user' => $user
        // ]);

        // return view('users.show', ['user' => $user]);

        return response()->json([
            'user' => new UserResource($user)
            // 'current_page' => $users->currentPage()
        ]);
    }

    public function edit(User $user)
    {
        $allRoles = Role::pluck('name')->toArray();

        $userRoles = $user->getRoleNames()->toArray();

        return response()->json([
            'allRoles' => $allRoles,
            'userRole' => $userRoles
        ]);

        // return view('users.edit', ['user' => $user, 'allRoles' => $allRoles, 'userRoles' => $userRoles]);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $user->update($request->safe()->except('roles'));

        $user->syncRoles($request->safe()->only('roles'));

        return response()->json([
            'message' => 'user has been updated successfully'
        ]);

        // return to_route('users.edit', $user->id)->with('User Update Success', 'User has been updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'user has been deleted successfully'
        ]);

        // return to_route('users.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('name', 'like', "%$search%")->paginate(5);

        return response()->json([
            'user' => UserResource::collection($users),
            'current_page' => $users->currentPage()
            // 'current_page' => $users->currentPage()
        ]);

        // return response()->json(['users' => $users]);

        // return view('users.search-results', ['users' => $users]);
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:Edit User|Delete User', only: ['index', 'show', 'search']),
            new Middleware('permission:Edit User', only: ['edit', 'update', 'search']),
            new Middleware('permission:Delete User', only: ['destroy', 'search'])
        ];
    }
}
