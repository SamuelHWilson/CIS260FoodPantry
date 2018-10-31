@extends('layouts.main-layout')

@section('title', 'Login Page')

@section('content')
    <form method="POST" action="/login">
        @csrf

        <p>Make up a fake email.</p>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        <p>Password</p>
        <input id="password" type="password" name="password" required>

        <input type="hidden" name="remember" id="remember" value='true'>

        <button type="submit">
            {{ __('Login') }}
        </button>
    </form>
@endsection