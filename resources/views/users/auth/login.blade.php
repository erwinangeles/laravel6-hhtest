@extends('layouts.app')

@section('body')
<div class="container bg-light" style="padding: 20px;">
    <h4>Login</h4>
    <form action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" name="email" value="{{old('email')}}">

            <label for="password">Password:</label>
            <input class="form-control" type="password" name="password">
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>
@endsection