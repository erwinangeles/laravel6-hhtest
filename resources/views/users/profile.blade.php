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


        <div id="attributes">
            <label for="name">Birthday: </label>
            <input class="form-control" type="date" name="birthday" value="{{old('birthday', $user->attributes()->first() ? $user->attributes()->first()->birthday : '')}}">  

            <label for="name">Gender: </label>
            <input class="form-control" name="gender" value="{{old('gender', $user->attributes()->first() ? $user->attributes()->first()->gender : '')}}">


            <label for="name">Country: </label>
            <input class="form-control" name="country" value="{{old('country', $user->attributes()->first() ? $user->attributes()->first()->country : '')}}">
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<script>
  
</script>
@endsection