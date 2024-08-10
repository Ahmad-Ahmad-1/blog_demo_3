{{-- <x-app-layout title="{{ $user->name }}"> --}}

@extends('layouts.app')

@section('title', $user->name)

@section('content')

    <div class="card w-50 m-auto mt-3">

        <div class="card-body">

            <h5 class="card-title fw-bold h4">
                <span>Name</span>
                <br>
                <div class="bg-primary p-2 text-white rounded d-inline-block mt-2">{{ $user->name }}</div>
            </h5>

            <h5 class="card-title fw-bold h4">
                <span>Email</span>
                <br>
                <div class="bg-primary p-2 text-white rounded d-inline-block mt-2">{{ $user->email }}</div>
            </h5>

            <h5 class="card-title fw-bold h4">
                <span>Create Date</span>
                <br>
                <div class="bg-primary p-2 text-white rounded d-inline-block mt-2">{{ $user->created_at }}</div>
            </h5>

            <h5 class="card-title fw-bold h4">
                <span>Last Update</span>
                <br>
                <div class="bg-primary p-2 text-white rounded d-inline-block mt-2">{{ $user->updated_at }}</div>
            </h5>

            <div class="mt-3">

                @can('Edit User')
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-dark">Edit</a>
                @endcan

                @can('Delete User')
                    <form action="{{ route('users.destroy', $user->id) }}" class="d-inline-block" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endcan

                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
            </div>

        </div>

    </div>

@endsection


{{-- </x-app-layout> --}}
