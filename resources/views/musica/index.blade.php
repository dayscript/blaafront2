@extends('layouts.app')

@section('title')
    Validación @parent
@endsection

@section('content')
    <div class="columns medium-4">
        <div class="search">
        </div>
    </div>
    <div class="columns medium-8">
        @foreach($nodes as $node)
            <div class="node">
                {{ $node->título }}
                <hr>
            </div>

        @endforeach
    </div>
@endsection
