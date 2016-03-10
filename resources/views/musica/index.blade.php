@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
    <div class="columns medium-4" ng-controller="ImageController">
      <div class="medium-12 image" ng-repeat="image in images" ng-if="$index < 3">
          <a href="@{{ image.nid }}"><img class="medium-12" ng-src="@{{image.Imagen.src}}" /></a>
      </div>
    </div>
    <div class="columns medium-4">
        <div class="search">
            <div class="about">Acerca de Opus</div>
            <div class="searchlabel">Haga aquí su búsqueda
                utilizando uno o más criterios:
            </div>
            <div class="fields" ng-controller="SearchController" >
                <form action="/musica" method="post">
                    {{ csrf_field() }}
                    <div class="field">
                        <label>Búsqueda general</label>
                        <input type="text" name="word_key" id="palabra_clave" placeholder="Busca en todos los campos">
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
                        <label for="name">Pais</label>
                        <select  name="country">
                          <option value ="all">Todos</option>
                          @foreach( $taxonomy as $node)
                            <option value ="{{$node->tid}}">{{ $node->name }}</option>
                          @endforeach
                        </select>
                        <label for="name">Instrumento</label>
                        <select name="instrument">
                          <option value ="all">Todos</option>
                          @foreach( $instruments as $node)
                            <option value ="{{$node->tid}}">{{ $node->name }}</option>
                          @endforeach
                       </select>
                       <md-slider-container>
                        <label>Especifique una Fecha:</label>
                        <label>Año:</label>
                        <md-slider flex=""
                                   min="1970"
                                   max="2016"
                                   ng-model="date.year"
                                   aria-label="year"
                                   id="year-slider">
                        </md-slider>
                        <label>Mes:</label>
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
                        </md-slider>
                        <md-input-container>
                          <input flex=""
                                 type="number"
                                 ng-model="date.year"
                                 aria-label="year"
                                 aria-controls="year-slider">
                        </md-input-container>
                        <md-input-container>
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
                        </md-input-container>
                      </md-slider-container>
                    </div>
                    <div class="field">
                        <input type="submit" value="buscar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="columns medium-4" ng-controller="ImageController">
      <div class="medium-12 image" ng-repeat="image in images" ng-if="$index > 2 && $index < 6">
        <a href="@{{ image.nid }}"><img class="medium-12" ng-src="@{{image.Imagen.src}}" /></a>
      </div>
    </div>

@endsection
