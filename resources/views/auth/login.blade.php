@extends('layouts.main-layout')

@section('title', 'Login Page')

@section('content')
    <form method="POST" action="/login">
        @csrf

        {{ $errors }}

        <p>What would you like to do?</p>
        <input type="radio" name="name" value="view" checked='checked'> View appointments.<br>
        <input type="radio" name="name" value="edit"> View and Edit appointments.<br>

        <p>Password</p>
        <input id="password" type="password" name="password" required>

        <input type="hidden" name="remember" id="remember" value='true'>

        <button type="submit">
            {{ __('Login') }}
        </button>
    </form>
@endsection