@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
	<h1>Dashboard</h1>
@endsection

@section('content')
	Welcome <strong>{{$user->name}}</strong>! <a href="/auth/logout">Logout</a>
@endsection