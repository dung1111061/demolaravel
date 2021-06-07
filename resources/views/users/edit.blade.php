@extends('adminlte::page')

@section('title', 'Create User')

@section('content')
@php
$action = route('user.update',['user' => $user->id]);
$method = 'PUT';
$disable = false;
@endphp
<x-user-form :projects='$projects' :departments='$departments' :user='$user' :action="$action" :method='$method' :disable='$disable'  >
</x-user-form>
	
@stop