@extends('layouts.app')

@section('title')
    Validación @parent
@endsection

@section('content')
    @foreach($nodes as $node)
        {{ $node->title }}
    @endforeach
@endsection
