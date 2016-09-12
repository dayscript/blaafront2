@extends('layouts.app')

@section('title')
    Opus @parent
@endsection
@section('content')
  <div class="column row collapse" ng-controller="ImageController">
    <div class="columns medium-4 collage-imagenes"  >
      <div class="medium-12 image-landing linkImage" ng-repeat="image in images" ng-if="$index <= 2">
        <a href="#">
        <figure style="background-image:url( @{{image}} )">
        </figure>
        </a>
      </div>
    </div>
    <div clas="medium-4 columns" style="display:inline">@include('partials.buscadorOpus')</div>
    <div class="columns medium-4 collage-imagenes"  >
      <div class="medium-12 image-landing linkImage" ng-repeat="image in images" ng-if="$index >= 3">
        <a href="#">
        <figure style="background-image:url( @{{image}} )">
        </figure>
        </a>
      </div>
    </div>
  </div>
@endsection
