@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
<div class="medium-12 columns breadcrumb">

</div>
@include('partials.LeftBar')
<div class="columns medium-9 detail">
  <div class="columns medium-12 borders-a padding-a">
    @foreach( $node as $value)
      <div class="medium-6 columns">
        @if(isset($value->imagen->src))
        <img class="thumbnail" src="{{$value->imagen->src}}"/>
        @else
        <img class="thumbnail" src="img/opus/Opus_default.png"/>
        @endif
      </div>
      <div class="medium-6 columns">
        <span class="text-gray">{{$value->titulo}}</span><br>
        <h4 class="text-gray">{{$value->titulo}}</h4>
        <span>{{$value->descripcion}}</span><br>
        <span class="bold">{{$value->fecha}}</span><br>
        <span class="text-gray coursive">Guitarra</span><br>
        <span class="text-gray">Colombia</span><br>
        <span class="bold">{{$value->ubicacion}}</span><br>
        <h6 class="bold">Grabación de archivo disponible: No</h6>

      </div>
    @endforeach
  </div>
  <div class="columns padding-a padding-b list-program">
    <h5> Programa Interpretado </h5>
    <ul>
      @foreach( $obras as $key => $value)
      <li>{{ $value }}</li>
      @endforeach
  </ul>
  </div>
</div>
@endsection
