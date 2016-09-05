@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
<div class="medium-12 columns breadcrumb">

</div>
@include('partials.buscadorOpus')
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
        <span class="text-gray concert-date coursive ">{{$node->fecha}}</span><br>
        <span class="text-gray concert-date coursive"> Código de registro: {{$node->registro}}</span><br>
        <h4 class="text-gray">{{$node->titulo}}</h4>
        <span class="text-gray">{{$node->serie_franja}}</span><br>
        <span class="text-gray">{{$node->instrumento_formato}}</span><br>
        <span class="text-red ">Notas al programa de mano: </span><span class="text-gray">{{$node->notas}}</span><br>

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
            <li class="text-gray">
                  <span class='item-li titulo medium-4'>{{ $value['integrante']->titulo }} </span>
                  @if($value['integrante']->fallecimiento != '0')
                    <span class='item-li medium-2'>{{ $value['integrante']->nacimiento }} -</span>
                  @else
                    <span class='item-li medium-2'> - </span>
                  @endif
                  @if($value['integrante']->fallecimiento != '0')
                    <span class='item-li medium-2' >{{ $value['integrante']->fallecimiento }} </span>
                  @else
                    <span class='item-li medium-2' > - </span>
                  @endif
                  <span class='item-li medium-2'>{{ $value['integrante']->pais }} </span>
                  <span class='item-li medium-2'>{{ $value['integrante']->instrumentos }} </span>

            </li>
          @endforeach
        @endif
    </ul>
  </div>
  <div class="medium-12 columns borders-a padding-a  padding-b list-program">
    <h5> Programa interpretado: </h5>
    <ul>
      @foreach( $node->obras as $key =>$value )
        <li class="text-gray ">
              <span class='item-li titulo medium-4'>{{ $value['obra']->titulo }} </span>
              @if($value['obra']->ano_composicion)
                <span class='item-li titulo medium-1'>({{ $value['obra']->ano_composicion }} )</span>
              @else
                <span class='item-li titulo medium-1'> - </span>
              @endif
              <span class='item-li medium-4 reds compositor'>{{ $value['obra']->titulo_compositor }} </span>
              <span class='item-li medium-1 año'> ( {{ $value['obra']->nacimiento }} </span>
              <span class='item-li medium-1 año'>{{ $value['obra']->fallecimiento }} ) </span>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@endsection
