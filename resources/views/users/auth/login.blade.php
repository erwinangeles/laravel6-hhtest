@extends('layouts.app')

@section('body')
<div class="container bg-light" style="margin-top: 40px; padding: 20px;">
    <h4>Login</h4>
    @if($errors->any())
    <p class="text-danger">Please addres the following errors:</p>
     <ul>
        @foreach ($errors->all() as $error )
        <li class="text-danger">{{$error}}</li>
        @endforeach
     </ul>
    @endif
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