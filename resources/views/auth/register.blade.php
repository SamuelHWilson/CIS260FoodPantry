@extends('layouts.main-layout')

@section('title', 'Home Page')

@section('content')
    <form method="POST" action="/register">
        @csrf

        <p>Name</p>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required>

        <p>Make up a fake email.</p>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        <p>Password</p>
        <input id="password" type="password" name="password" required>

        <p>Confirm</p>
        <input id="password-confirm" type="password" name="password_confirmation" required>

        <button type="submit">
            {{ __('Register') }}
        </button>
    </form>
@endsection