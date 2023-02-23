@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ url('admin/' . $user->id) }}" method="post">
            @csrf
            @method('put')
    		<input id="iduser" name="iduser" class="hidden" value="{{ $user->id }}">
            <div class="form-group">
                <label for="name">User name</label>
                <input value="{{ old('name', $user->name) }}" required type="text" minlength="2" maxlength="100" class="form-control" id="nombre" name="name" placeholder="User name">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">User email</label>
                <input value="{{ old('email', $user->email) }}" required type="text" minlength="2" maxlength="100" class="form-control" id="email" name="email" placeholder="User email">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" required>
                    @foreach ($types as $index => $type)
                      <option value="{{ $index }}" @if($user->type == $index) selected @endif> {{ $type }}</option>
                    @endforeach
                </select>
                @error('type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">User password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="User password" >
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
            &nbsp;
            <a href="{{ url('admin') }}" class="btn btn-primary">Back</a>
        </form>
    </div>
@endsection