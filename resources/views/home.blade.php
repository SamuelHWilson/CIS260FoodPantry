@extends('layouts.main-layout')

@section('title', 'Home Page')

@section('content')
    <p><a href="{{ route('login') }}">Login</a></p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <input type="submit" value='Logout'>
    </form>

    @if (Auth::check())
        <p>{{ Auth::user() }}</p>
    @else
        <p>no auth</p>
    @endif

    <h1>This is the content</h1>
@endsection