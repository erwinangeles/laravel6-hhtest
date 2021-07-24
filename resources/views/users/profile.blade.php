@extends('layouts.app')

@section('body')
<div class="container bg-light" style="margin-top: 20px; padding: 20px;">
    Welcome, <strong>{{$user->name}}.</strong> You can view or update your profile details below.
    <hr>
    <form action="{{route('user.update')}}" method="POST">
        @csrf
        <label for="name">Name: </label>
        <input class="form-control" name="name" value="{{old('name', $user->name)}}">
        <labeL for="email">Email: </label>
        <input class="form-control" name="email" type="email" value="{{old('email', $user->email)}}">

        <label for="password">New Password: </label>
        <input class="form-control" name="password" type="password" value="">
        <label for="name">Confirm New Password: </label>
        <input class="form-control" name="password_confirmation" type="password" value="">

        <br>
        <button type="submit" class="btn btn-primary">Update Profile</button>

    </form>
</div>

<script>
  
</script>
@endsection