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
        <div class="paginator row columns">
            <div class="medium-3 items-search columns">
                <label class="medium-12">{{$itemSearch}}</label>
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
            <div class="medium-2 columns">
              <div class="row order-by">
                  <div class="medium-6 columns">
                      <label>Ordenar: </label>
                  </div>
               <div class="medium-6 columns">
                   <a href="{{Request::path().$Params->str_params}}" id="order-by"></a>
               </div>
              </div>
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
                  @if(isset($node->imagen->src))
                    <img src="{{ $node->imagen->src  }}" alt="Artista">
                  @else
                    <img src="{{ asset('img/opus/Opus_default.png') }}" alt="Artista">
                  @endif
                </div>
                <div class="columns medium-6 node">
                    <span class="concert-date">{{ $node->fecha }} </span>
                    <span class="concert-code"> CÓDIGO DE REGISTRO:  {{ $node->registro }}</span>
                    <span class="concert-artist"><a href="musica/concierto/{{ $node->nid }}">{{ $node->titulo }}</a></span><br>
                    <span class="concert-title">{{ $node->programa_serie }}</span>
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
    </div>
@endsection
