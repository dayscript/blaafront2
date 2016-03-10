@extends('layouts.app')
@section('title')
    Validación @parent
@endsection
@section('content')
    @include('partials.facetsSearch')
    <div class="columns medium-8 results-view">
        <div class="filters">
            <form action="/musica" method="post">
                {{ csrf_field() }}
                <div class="fields">
                <div class="field">
                    <label for="name">Buscar</label>
                    <input type="text" name="name" id="name" placehorlder ="| Buscar">
                </div>
                <div class="field">
                    <input type="submit" value="buscar">
                </div>
                </div>
            </form>
        </div>
        <div class="results medium-12">
        @foreach($nodes as $node)
            <div class="row">
                <div class="columns medium-3 node">
                    <img src="{{ asset('img/opus/artist.png') }}" alt="Artista">
                </div>
                <div class="columns medium-6 node">
                    <span class="concert-date">{{ $node->Fecha }}</span><br>
                    <span class="concert-artist"><a href="musica/concierto/{{ $node->nid }}">{{ $node->Artistas }}</a></span><br>
                    <span class="concert-title">{{ $node->Título }}</span><br>
                    @if ( $node->Instrumentos != '' &&  $node->País != '' )
                      <span class="concert-instrument">{{ $node->Instrumentos }} | {{ $node->País }}</span>
                    @endif
                </div>
                <div class="columns medium-2 node" >
                  <img src=""><a>Programa de mano</a></img>
                </div>
            </div>
            <hr>
        @endforeach
        </div>
    </div>
@endsection
