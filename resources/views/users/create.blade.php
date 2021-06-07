@extends('adminlte::page')

@section('title', 'Create User')

@section('content')
@php
$action = route('user.store');
@endphp
<x-user-form :projects='$projects' :departments='$departments' :action="$action" >
</x-user-form>
	
@stop


