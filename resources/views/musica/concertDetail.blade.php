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
        <span class="text-gray concert-date ">{{Date::parse( date ( 'Y-m-j' ,strtotime ( '-1 day' , strtotime ( $node->fecha ) ) ) )->format("l, j F Y") }} </span>
        <span class="text-gray concert-code "> Código de registro: {{$node->registro}}</span>
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

      <table class="concert" style="width: 100%">
        <thead>
          <tr><td>No.</td><td width="230"> Nombre </td><td> Instrumento </td><td> País </td><td> Año Nacimiento </td></tr>
        </thead>
        <tbody>
          @if($node->integrantes[0] != 'Undefined')
            @foreach( $node->integrantes as $key =>$value )
          <tr>
            <td>{{$key+1}} </td>
            <td>{{$value['integrante']->titulo }} </td>
            <td>{{ $value['integrante']->instrumentos }}</td>
            <td>{{ $value['integrante']->pais }}</td>
            <td>{{ ($value['integrante']->nacimiento != '0') ? $value['integrante']->nacimiento.' - ' :' '}}  {{ ($value['integrante']->fallecimiento != '0')?$value['integrante']->fallecimiento:'&nbsp;' }}</td>
          </tr>
          @endforeach
        @endif
      </table>
  </div>
  <div class="medium-12 columns borders-a padding-a  padding-b list-program">
    <h5> Programa interpretado: </h5>
      <table style="width: 100%">
        <thead>
          <tr><td>No.</td><td width="200"> Obra </td><td> Año </td><td> Compositor </td><td> Año de nacimiento y muerte </td></tr>
        </thead>
        <tbody>
        @foreach( $node->obras as $key =>$value )
        <tr>
          <td>{{$key+1}} </td>
          <td>{{$value['obra']->titulo }} </td>
          <td>{{ ($value['obra']->ano_composicion != '0')?$value['obra']->ano_composicion:'&nbsp;' }}</td>
          <td>{{ $value['obra']->titulo_compositor }}</td>
          <td>{{ ($value['obra']->nacimiento !='0')? $value['obra']->nacimiento.' - ' :'&nbsp;' }} {{ ($value['obra']->fallecimiento != '0')?$value['obra']->fallecimiento:'&nbsp;' }}</td>
        </tr>
        @endforeach
      </tbody>
      </table>
    </ul>
  </div>
</div>
@endsection
