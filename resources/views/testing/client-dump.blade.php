@extends('layouts.main-layout')

@section('title', 'All Clients')

@section('content')
    @foreach ($clients as $client)
        <p>{{$client->Last_Name.", ".$client->First_Name}}:</p>
        <p>{{$client}}</p>
        <br><br>
    @endforeach
@endsection