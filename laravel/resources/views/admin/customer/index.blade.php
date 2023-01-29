@extends('layouts.layout')

@section('content')

    <h1>All Customers</h1>
    <p>This is a list of users (customers). A user can have many meters.</p>
    <br>
    <br>
    <ul>
    @foreach(\App\Models\User::all() as $user)
        <li>{{ $user->name }}</li>

    @endforeach
    </ul>    @endsection