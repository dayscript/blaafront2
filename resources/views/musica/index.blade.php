@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
  <div class="column row collapse">
    <div class="columns medium-4 collage-imagenes" ng-controller="ImageController1" >
      <div class="medium-12 image-landing linkImage" ng-repeat="image in images">
        <a href="#">
        <figure style="background-image:url( @{{image.Imagen.src}} )">
        </figure>
        </a>

      </div>
    </div>
    @include('partials.buscadorOpus')
    <div class="columns medium-4 collage-imagenes" ng-controller="ImageController2" >
      <div class="medium-12 image-landing linkImage" ng-repeat="image in images">
        <a href="#">
        <figure style="background-image:url( @{{image.Imagen.src}} )">
        </figure>
        </a>
      </div>
    </div>
  </div>


@endsection
