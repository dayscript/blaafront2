@extends('layouts.app')
@section('title')
    Validación @parent
@endsection
@section('content')
    @include('partials.buscadorOpus')
    <div class="columns medium-8 results-view">
        <div class="filters">
            <form action="/musica" method="post">
                {{ csrf_field() }}
                <div class="fields medium-12 columns block">
                    <div class="field medium-7 block">
                        <label for="name" class="red">Relizar nueva búsqueda</label>
                        <input type="text" name="artist" id="artist" placehorlder ="Buscar"></input>
                        <input type="submit" value="buscar" class="columns medium-3">
                    </div>
                    <div class="fields medium-12 block">
                         <label for="name"><a href="/musica">Búsqueda avanzada</a></label>
                    </div>
                </div>
            </form>
        </div>
        <div class="paginator medium-12 row collapse">
            <div class="medium-5 columns">

                <label class="medium-12"><strong>{{$itemSearch}}</strong></label>

                <label class="medium-12 red"><strong>{{$nodes->view->count}}</strong> Resultados</label>
            </div>
            <div class="medium-4 columns number-items">
                <span>Resultados por pagina </span>
                <select id="number-items" onchange=" this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value); ">
                  <option value="musica/resultados/0?items=10">10</option>
                  <option value="musica/resultados/0?items=20">20</option>
                  <option value="musica/resultados/0?items=30">30</option>
                  <option value="musica/resultados/0?items=40">40</option>
                  <option value="musica/resultados/0?items=50">50</option>
                </select>
            </div>
            <div class="medium-3 columns number-page">
              <ul class="pagination" role="menubar" aria-label="Pagination">
                <li class="arrow unavailable" aria-disabled="true"><a href="musica/resultados/{{ $nodes->view->page-1 }}">&laquo; </a></li>
                @for( $i = $nodes->view->page+1 ; $i <= $nodes->view->pages; $i++ )
                    @if( $i <= $nodes->view->page+4)
                          <li class="{{ ($nodes->view->page+1 == $i ) ? 'current':'' }}"><a href="/musica/resultados/{{$i-1}}">{{$i}}</a></li>
                    @endif
                @endfor
                <li class="arrow"><a href="musica/resultados/{{ $nodes->view->page+1 }}"> &raquo;</a></li>
              </ul>
            </div>
        </div>
        <div class="results medium-12 columns">
        @foreach($nodes->nodes as $node)
            <div class="row">
                <div class="columns medium-3 node">
                    <img src="{{ asset('img/opus/Opus_default.png') }}" alt="Artista">
                </div>
                <div class="columns medium-6 node">
                    <span class="concert-date">{{ $node->fecha }}</span><br>
                    <span class="concert-artist"><a href="musica/concierto/{{ $node->nid }}">{{ $node->titulo }}</a></span><br>
                    <span class="concert-title">{{ $node->programa_serie }}</span><br>
                    @if ( $node->instrumentos != '' &&  $node->pais != '' )
                      <span class="concert-instrument">{{ $node->instrumentos }} | {{ $node->pais }}</span>
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
