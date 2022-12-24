@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
<h1 class="m-0 text-dark">Profile</h1>
@stop

    @section('content')
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <h3 class="profile-username text-center">{{ $user->name }}</h3>
            <p class="text-muted text-center">{{ $user->email }}</p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Username</b> <a class="float-right">{{ $user->name }}</a>
                </li>
                <li class="list-group-item">
                    <b>Role</b> <a class="float-right">{{ $role->name }}</a>
                </li>
                <li class="list-group-item">
                    <b>Email Adress</b> <a class="float-right">{{ $user->email }}</a>
                </li>
                <li class="list-group-item">
                    <b>Email verified</b> @if ($user->email_verified_at == null)
                        <a class="float-right">Not verified</a>
                    @else
                        <a class="float-right">Verified at {{ $user->email_verified_at }}</a>
                    @endif
                </li>
                <li class="list-group-item">
                    <b>Created at</b> <a class="float-right">{{ $user->created_at }}</a>
                </li>
            </ul>
        </div>

    </div>
    @stop
