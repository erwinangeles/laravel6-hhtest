@extends('layouts.app')

@section('body')
<div class="container bg-light" style="padding: 20px;">
    <h4>Create an Account</h4>
    <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" name="name" value="{{old('name')}}">

            <label for="email">Email:</label>
            <input class="form-control" name="email" value="{{old('email')}}">

            <label for="password">Password:</label>
            <input class="form-control" type="password" name="password">

            <label for="password_confirm">Confirm Password:</label>
            <input class="form-control" type="password" name="password_confirmation">

            <br>
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>
@endsection