@extends('layouts.app')

@section('title')
    Opus @parent
@endsection
@section('content')
<div class="medium-4 columns">
@include('partials.buscadorOpus')
@include('partials.ayudanos')
</div>
<div class="columns medium-8 detail node-detail">
  <div class="columns medium-12 borders-a padding-a">
      <div class="medium-5 columns">
        @if(isset($node->imagen->src))
        <img class="thumbnail" src="{{$value->imagen->src}}"/>
        @else
        <img class="thumbnail" src="{{ asset('img/opus/Opus_default.png') }}"/>
        @endif
      </div>
      <div class="medium-7 columns relative">
        <span class="text-gray concert-date ">{{$node->fecha}}</span>
        <span class="text-gray concert-code "> CÓDIGO DE REGISTRO: {{$node->registro}}</span>
        <h4 class="text-gray">{{$node->titulo}}</h4>
        <span class="text-gray serie">{{$node->serie_franja}}</span>
        <span class="text-gray instrumento">{{$node->instrumento_formato}}</span>
        <span class="text-red notas">Notas al programa de mano: </span><span class="text-gray notas">{{$node->notas}}</span><br>
        @if( $node->adjunto !='' )
         <a id="icono_programa" class="programa-en-detalle" target="_blank" href="http://quimbaya.banrep.gov.co/conciertos/documentos/{{$node->adjunto}}"></a>
        @endif
      </div>
  </div>
  <div class="columns borders-a padding-a padding-b list-program">
      <h5> Artistas: </h5>
      <ul>
        @if($node->integrantes[0] != 'Undefined')
          @foreach( $node->integrantes as $key =>$value )
            <li class="text-gray columns ">
                  <div class='item-li columns reds titulo medium-4'>
                    <span class="text-red">{{$key+1}}.</span>
                    <span data-tooltip aria-haspopup="true" class="" title="{{ $value['integrante']->titulo }}">{{$value['integrante']->titulo }}
                  </div>
                  <div class='item-li columns medium-2'>{{ ($value['integrante']->nacimiento != '0') ? $value['integrante']->nacimiento.' - ' :' '}}  {{ ($value['integrante']->fallecimiento != '0')?$value['integrante']->fallecimiento:'&nbsp;' }}</div>
                  <div class='item-li columns medium-3'>{{ $value['integrante']->pais }} </div>
                  <div class='item-li columns medium-3 end'>{{ $value['integrante']->instrumentos }} </div>
            </li>
          @endforeach
        @endif
    </ul>
  </div>
  <div class="medium-12 columns borders-a padding-a  padding-b list-program">
    <h5> Programa interpretado: </h5>
    <ul>
      @foreach( $node->obras as $key =>$value )
        <li class="text-gray columns ">
          <div class="medium-12">
              <div class='item-li columns titulo medium-4'>
                <span class="text-red">{{$key+1}}.</span>
                <span data-tooltip aria-haspopup="true" class="" title="{{$value['obra']->titulo }}">{{$value['obra']->titulo }}  
              </div>
              <div class='item-li columns titulo medium-2'>{{ ($value['obra']->ano_composicion != '0')?$value['obra']->ano_composicion:'&nbsp;' }}</div>
              <div class='item-li columns medium-3 compositor'>{{ $value['obra']->titulo_compositor }}</div>
              <div class='item-li columns medium-3'> {{ ($value['obra']->nacimiento !='0')? $value['obra']->nacimiento.' - ' :'&nbsp;' }} {{ ($value['obra']->fallecimiento != '0')?$value['obra']->fallecimiento:'&nbsp;' }}</div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@endsection
