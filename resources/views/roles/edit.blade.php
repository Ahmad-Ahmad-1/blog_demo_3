{{-- <x-app-layout title="Edit {{ $role->name }}"> --}}

@extends('layouts.app')

@section('title', $role->name)

@section('content')

    <x-flash-messages type="success" class="w-50" />

    <div class="card w-50 m-auto mt-3">

        <div class="card-body">

            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('put')

                <div>
                    <label for="{{ $role->name }}" class="h4">Role:</label>
                    <x-text-input name="name" value="{{ $role->name }}" class="form-control mt-2 mb-2"
                        id="{{ $role->name }}" />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="mt-3">

                    <label for="" class="h4 fw-bold">Permissions:</label>

                    @foreach ($allPermissions as $permission)
                        <div class="p-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission }}" id="{{ $permission }}"
                                @checked(in_array($permission, $rolePermissions))>
                            <label for="{{ $permission }}">{{ $permission }}</label>
                        </div>
                    @endforeach

                    <x-input-error :messages="$errors->get('permissions')" />
                </div>

                <button type="submit" class="btn btn-success mt-3">Update</button>
            </form>
        </div>

    </div>

@endsection

{{-- </x-app-layout> --}}
