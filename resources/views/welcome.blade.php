@extends('layouts.app')
@section('body')
<div class="container bg-light" style="margin-top: 30px; padding: 20px;">
    <p><strong>Using Laravel 6 (since it is the current LTS release) implement the following:</strong></p>
    <ul>
    <li>A user system with authentication and registration controllers/views</li>
    </ul>
    <ul>
    <ul>
    <li>Include a separate user_attributes table that allows a user to enter and store their birthday, gender, and country</li>
    </ul>
    </ul>
    <ul>
    <li>A user profile page that can only be viewed after logging in that lets them view and update their login details and attributes</li>
    <li>A console command that will export users and their attributes to a CSV when run</li>
    <li>Exposes a REST API that can be used to validate user credentials and get/update their attributes with authorized API key(s)</li>
    </ul>
    <ul>
    <ul>
    <li>API key(s) can be a single key from pulled from an environment variable or a table in the DB that can store multiple keys, your choice</li>
    </ul>
    </ul>
    <ul>
    <li>PHPUnit tests that provide code coverage for all the custom written code</li>
    </ul>
</div>
@endsection