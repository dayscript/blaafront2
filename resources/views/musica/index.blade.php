@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
  <div class="column row collapse">
    <div class="columns medium-4 collage-imagenes" ng-controller="ImageController1" >
      <div class="medium-12 image-landing" ng-repeat="image in images">
        <figure style="background-image:url(@{{image.Imagen.src}});">
          <img class="medium-12 image-landing" ng-src="@{{image.Imagen.src}}" />
        <figure>
      </div>
    </div>
    @include('partials.buscadorOpus')
    <div class="columns medium-4 collage-imagenes" ng-controller="ImageController2" >
      <div class="medium-12  image-landing" ng-repeat="image in images">
        <a><img class="medium-12 image-landing" ng-src="@{{image.Imagen.src}}" /></a>
      </div>
    </div>
  </div>


@endsection
