@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
    <div class="columns medium-4" ng-controller="ImageController1" >
      <div class="medium-12 image" ng-repeat="image in images" style="height: 180px;" >
          <a><img class="medium-12" ng-src="@{{image.Imagen.src}}" /></a>
      </div>
    </div>

    <div class="columns medium-4">
        <div class="search">
            <div class="about"><a href="/acerca-de-opus" class="acerca-de-opus">Acerca de Opus</a>  </div>
            <div class="searchlabel">Haga aquí su búsqueda
                utilizando uno o más criterios:
            </div>
            <div class="fields" ng-controller="SearchController" >
                <form action="/musica" method="post">
                    {{ csrf_field() }}
                    <div class="field medium-12">
                        <div class="medium-12 input">
                          <label>Búsqueda general</label>
                          <input type="text" name="word_key" id="palabra_clave" placeholder="Busca en todos los campos">
                        </div>
                        <div class="medium-12 input">
                        <label for="name">Artista</label>
                          <md-autocomplete
                            md-input-name="artist"
                            md-search-text="searchText"
                            md-search-text-change="searchTextChange(searchText)"
                            md-selected-item="selectedItem"
                            md-items="autor in CallBackFilter(searchText)"
                            md-item-text="item.name"
                            placeholder="Escriba un autor">
                            <span md-highlight-text="searchText" md-highlight-flags="^i" >@{{autor}}</span>
                          </md-autocomplete>
                        </div>
                        <div class="medium-12 input">
                        <label for="name">Compositor</label>
                        <md-autocomplete
                          md-input-name="composer"
                          md-search-text="searchTextComposer"
                          md-search-text-change="searchTextChange(searchTextComposer)"
                          md-selected-item="selectedItemComposer"
                          md-items="composer in CallBackFilterComposers(searchTextComposer)"
                          md-item-text="composer.name"
                          placeholder="Escriba un compositor">
                          <span md-highlight-text="searchText" md-highlight-flags="^i" >@{{composer}}</span>
                        </md-autocomplete>
                        </div>
                        <div class="medium-12 input">
                        <label for="name">Serie</label>
                        <select name="serie">
                          <option value ="all">Todas</option>
                          @foreach( $series as $serie)
                            <option value ="{{$serie->tid}}">{{ $serie->name }}</option>
                          @endforeach
                       </select>
                       </div>
                        <div class="medium-12 input">
                        <label for="name">Pais</label>
                        <select  name="country">
                          <option value ="all">Todos</option>
                          @foreach( $taxonomy as $node)
                            <option value ="{{$node->tid}}">{{ $node->name }}</option>
                          @endforeach
                        </select>
                        </div>
                        <div class="medium-12 input">
                        <label for="name">Instrumento</label>
                        <select name="instrument">
                          <option value ="all">Todos</option>
                          @foreach( $instruments as $node)
                            <option value ="{{$node->tid}}">{{ $node->name }}</option>
                          @endforeach
                       </select>
                       </div>
                       <div class="medium-12 input">
                       <md-slider-container>
                        <label>Especifique un año:</label>
                        <!--<label>Año:</label>-->
                        <md-slider flex=""
                                   min="1970"
                                   max="2016"
                                   ng-model="date.year"
                                   aria-label="year"
                                   id="year-slider"
                                   class="medium-6 columns">
                        </md-slider>
                        <!--<label>Mes:</label>
                        <md-slider flex=""
                                   min="1"
                                   max="12"
                                   ng-model="date.month"
                                   aria-label="month"
                                   id="month-slider">
                        </md-slider>
                        <label>Día:</label>
                        <md-slider flex=""
                                   min="1"
                                   max="31"
                                   ng-model="date.day"
                                   aria-label="day"
                                   id="day-slider">
                        </md-slider>-->
                        <md-input-container class="medium-6 columns">
                          <input flex=""
                                 name="year"
                                 type="number"
                                 ng-model="date.year"
                                 aria-label="year"
                                 aria-controls="year-slider"
                                 class="medium-12 columns year"
                                 >
                        </md-input-container>
                        <!--<md-input-container>
                          <input flex=""
                                 type="number"
                                 ng-model="date.month"
                                 aria-label="month"
                                 aria-controls="month-slider">
                        </md-input-container>
                        <md-input-container>
                          <input flex=""
                                 type="number"
                                 ng-model="date.day"
                                 aria-label="day"
                                 aria-controls="day-slider">
                        </md-input-container>-->
                      </md-slider-container>
                      </div>
                    </div>
                    <div class="field medium-12">
                        <input type="submit" class="medium-12"  value="Buscar">
                        <input type="reset" class="medium-12"  value="Borrar">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="columns medium-4" ng-controller="ImageController2" >
      <div class="medium-12 image" ng-repeat="image in images" style="height: 180px;">
        <a><img class="medium-12" ng-src="@{{image.Imagen.src}}" /></a>
      </div>
    </div>

@endsection
