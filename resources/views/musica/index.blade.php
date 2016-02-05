@extends('layouts.app')

@section('title')
    Validación @parent
@endsection

@section('content')
    <div class="columns medium-4">
        <div class="search">
        </div>
    </div>
    <div class="columns medium-8 search">
        <div class="filters">
            <form action="/musica" method="post">
                {{ csrf_field() }}
                <div class="fields">
                <div class="field">
                    <label for="name">Buscar</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="field">
                    <input type="submit" value="buscar">
                </div>
                </div>
            </form>
        </div>
        <div class="results">
        @foreach($nodes as $node)
            <div class="row">
                <div class="columns medium-4 node">
                    <img src="{{ asset('img/opus/artist.png') }}" alt="Artista">

                </div>
                <div class="columns medium-8 node">
                    <div class="name">{{ $node->título }}</div>
                </div>
            </div>
            <hr>
        @endforeach
        </div>
    </div>
@endsection
