@extends('adminlte::page')

@section('title', 'Ubah Password')

@section('content_header')
    <h1 class="m-0 text-dark">Ubah Password</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            {{ __('Ubah Password Akun') }}
        </div>
        <div class="card-body">
            <form action="{{ route('ubah.password') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="old_password">Current Password</label>
                            <input type="password" name="old_password" id="old_password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Retype New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 row justify-content-end">
                        <button class="btn btn-primary" type="submit">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
