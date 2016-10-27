@extends('layouts.app')
@section('title')
    Validación @parent
@endsection
@section('content')
    <div class="medium-4 columns">
    @include('partials.buscadorOpus')
    @include('partials.ayudanos')
    </div>
    <div class="columns medium-8 results-view">
      @include('partials.paginator')
        <div class="results medium-12 columns">
        @foreach($nodes->nodes as $node)
            <div class="row">
                <div class="columns medium-3 node">
                  @if(isset($node->imagen->src))
                    <img src="{{ $node->imagen->src  }}" alt="Artista">
                  @else
                    <img src="{{ asset('img/opus/Opus_default.png') }}" alt="Artista">
                  @endif
                </div>
                <div class="columns medium-6 node">
                    <!--<span class="concert-date">{{ Date::parse($node->fecha)->format("l, j F Y") }} </span>-->
                    <span class="concert-date">{{Date::parse( date ( 'Y-m-j' ,strtotime ( '-1 day' , strtotime ( $node->fecha ) ) ) )->format("l, j F Y") }} </span>
                    <span class="concert-code"> Código de registro:  {{ $node->registro }}</span>
                    <span class="concert-artist"><a href="musica/opus/concierto/{{ $node->nid }}">{{ $node->titulo }}</a></span><br>
                    <span class="concert-serie">{{ $node->programa_serie }}</span><br>
                    @if ( $node->instrumento != '' &&  $node->pais != '' )
                      <span class="concert-instrument">{{ $node->instrumento }} | {{ $node->pais }}</span>
                    @endif
                </div>
                <div class="columns medium-2 node" >
                  @if( $node->adjunto != '')
                  <a id="icono_programa" target="_blank" href="{{ $node->adjunto }}"></a>
                  @endif
                </div>
            </div>
            <hr>
        @endforeach
        </div>

        @include('partials.paginator')

    </div>
@endsection
