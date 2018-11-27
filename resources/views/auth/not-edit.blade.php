@extends('layouts.main-layout')

@section('title', 'Home Page')

@section('content')
    <p>You are not edit.</p>
    <form method="POST" action="{{ route('logout') }}" id='logout'>
        @csrf
    </form>
    <p onclick='document.forms.namedItem("logout").submit()'><a>Log in as edit.</a></p>
    <a href='{{ url()->previous() }}'><p>go back</p></a>
@endsection