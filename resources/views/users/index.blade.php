@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
@php
$heads = [
    'Name',
    'Email',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];
$config = [
    
];
@endphp

<x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable bordered compressed>
    @foreach($users as $user)
        <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>
                    <nobr>    
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <a href="{!! route('user.edit',[ 'user'=> $user->id ]) !!}"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                    </button>
                        <form action="{{ route('user.destroy',[ 'user'=> $user->id ]) }}" method="POST" style="display: inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                        </form>
                    <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                        <a href="{!! route('user.show',[ 'user'=> $user->id ]) !!}"><i class="fa fa-lg fa-fw fa-eye"></i></a>
                    </button>
                    </nobr>
                </td>
        </tr>
    @endforeach
</x-adminlte-datatable>
@stop



@section('js')
<script type="text/javascript">
    $('#table1').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );    
</script>
@stop


