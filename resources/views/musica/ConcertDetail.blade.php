@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
<div class="medium-12 columns breadcrumb">

</div>
@include('partials.LeftBar')
<div class="columns medium-9 detail node-detail">
  <div class="columns medium-12 borders-a padding-a">
      <div class="medium-6 columns">
        @if(isset($node->imagen->src))
        <img class="thumbnail" src="{{$value->imagen->src}}"/>
        @else
        <img class="thumbnail" src="{{ asset('img/opus/Opus_default.png') }}"/>
        @endif
      </div>
      <div class="medium-6 columns">
        <span class="text-gray">{{$node->fecha}}</span><br>
        <h4 class="text-gray">{{$node->titulo}}</h4>
        <span class="text-gray">{{$node->serie_franja}}</span><br>
        <h6>Artistas:<h6>
        <ul>
          @foreach( $node->artistas as $key =>$value )
            <li class="text-gray"> {{ $value->artista[0]->titulo }} </li>
          @endforeach
        </ul>

        <span></span><br>
        <span class="bold"></span><br>
        <span class="text-gray coursive"></span><br>
        <span class="text-gray"></span><br>
        <span class="bold"></span><br>
      </div>

  </div>
  <div class="columns borders-a padding-a padding-b list-program">
    <h5> Integrantes: </h5>
    <ul> 
      @foreach( $node->integrantes as $key =>$value )
        @foreach( $value->integrante as $key =>$value )
        <li class="text-gray">
              <span class='item-li titulo medium-4'>{{ $value->titulo }} </span>
              <span class='item-li medium-2'>{{ $value->nacimiento }} -</span>
              <span class='item-li medium-2' >{{ $value->fallecimiento }} </span>
              <span class='item-li medium-2'>{{ $value->pais }} </span>
        </li>
        @endforeach
      @endforeach
  </ul>

</div>
<div class="medium-12 columns borders-a padding-a  padding-b list-program">
  <h5> Programa Interpretado: </h5>
  <ul>
    @foreach( $node->obras as $key =>$value )
      @foreach( $value->obra as $key =>$value )
      <li class="text-gray ">
            <span class='item-li titulo medium-4'>{{ $value->titulo }} </span>
            <span class='item-li medium-4 red compositor'>{{ $value->titulo_compositor }} </span>
            <span class='item-li medium-1 año'> ( {{ $value->nacimiento }} </span>
            <span class='item-li medium-1 año'>{{ $value->fallecimiento }} ) </span>

      </li>
      @endforeach
    @endforeach
</ul>
  </div>
</div>
@endsection
