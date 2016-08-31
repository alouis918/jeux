@extends('layouts.app')

@section('content')
    @if($task)
        {{$task}}
    @else
    There is no task with these id
    @endif

@endsection