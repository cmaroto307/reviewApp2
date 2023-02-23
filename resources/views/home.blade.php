@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                        <br>
                        @if(Auth::user()->hasVerifiedEmail())
                            You are verified
                        @else
                            <a href="email/verify">Verify your email</a>
                        @endif
                        <br>
                        @if (Auth::user()->isAdmin())
                            <a href="{{ url('admin') }}">Admin Administration</a>
                        @endif
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="margin: 8px;">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseUser" role="button" aria-expanded="false" aria-controls="collapseUser">
                        Edit your data
                    </a>
                </p>
                <div class="collapse" id="collapseUser">
                    <div class="card card-body">
                        <form action="{{ url('user/update') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">User name</label>
                                <input value="{{ old('name', Auth::user()->name) }}" required type="text" minlength="2" maxlength="100" class="form-control" id="nombre" name="name" placeholder="User name">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">User email</label>
                                <input value="{{ old('email', Auth::user()->email) }}" required type="email" minlength="2" maxlength="100" class="form-control" id="email" name="email" placeholder="User email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="old_password">Old password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password" >
                                @error('old_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">New password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="New password" >
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation" >
                                @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Edit</button>
                                &nbsp;
                                <a href="{{ url('/home') }}" class="btn btn-primary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection