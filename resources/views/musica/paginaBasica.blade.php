@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
<div class="content-wrapper" ng-controller="PageController">
  <div class="row columns">
    <div class="columns large-centered medium-10">
      <div class="columns medium-10 padding-button">
        <h5 class="red"> Acerca de OPUS</h5>
        <span class="red">Histórico de conciertos del banco de la república</span>
      </div>
      <div class="columns medium-12">
        <div class="row">
          <div class="columns medium-12">
            <img src="{{asset('img/imagen_acerca_de.png')}}">
              <div>
                <p class="text-image-left" ng-bind-html="content">
                </p>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
