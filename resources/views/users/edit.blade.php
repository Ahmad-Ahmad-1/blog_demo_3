{{-- <x-app-layout title="Edit {{ $user->name }}"> --}}

    @extends('layouts.app')

    @section('title', $user->name)

    @section('content')

    <x-flash-messages type="success" class="w-50" />

    <div class="card m-auto mt-3 w-50">
        <div class="card-body">

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('put')

                <div>
                    <label for="name" class="h4">Name</label>
                    <x-text-input name="name" class="form-control" value="{{ $user->name }}" />
                    <x-input-error :messages="session()->get('name')" />
                </div>

                <div class="mt-3">
                    <label for="roles" class="h4">Roles</label>

                    @foreach ($allRoles as $role)
                        <div>
                            <input name="roles[]" type="checkbox" value="{{ $role }}" id="{{ $role }}"
                                @checked(in_array($role, $userRoles))>

                            <label for="{{ $role }}">{{ $role }}</label>
                        </div>
                    @endforeach

                    <x-input-error :messages="session()->get('roles')" />
                </div>

                <button type="submit" class="btn btn-primary mt-3 fw-bold">Update</button>

            </form>

        </div>
    </div>

    @endsection

{{-- </x-app-layout> --}}
