<!-- Dayscript 2016 all rigths reserved -->
<!-- Seccion Search for facets -->
<div class="columns medium-4 ">
  <div class="search">
    <div class="fields" ng-controller="SearchController">
      <div class="  medium-12">
          <span>Filtre su busqueda por:</span>
      </div>
      <form action="/musica1" method="post" >
        {{ csrf_field() }}
        <div class=" medium-12 filter-accordion ng-controller="SearchController" ">
          <ul class="accordion" data-accordion >
            <li class="accordion-item" data-accordion-item>
              <a href="#" class="accordion-title">Artista</a>
              <div class="accordion-content" data-tab-content>
                <md-autocomplete
                  md-input-name="artist"
                  md-search-text="searchText"
                  md-search-text-change="searchTextChange(searchText)"
                  md-selected-item="selectedItem"
                  md-items="item in CallBackFilter(searchText)"
                  md-item-text="item.name"
                  placeholder="Escriba un autor">
                  <span md-highlight-text="searchText" md-highlight-flags="^i" >@{{item}}</span>
                </md-autocomplete>
              </div>
            </li>
            <li class="accordion-item " data-accordion-item>
              <a href="#" class="accordion-title">Compositor</a>
              <div class="accordion-content" data-tab-content>
                <md-autocomplete
                  md-input-name="composer"
                  md-search-text="searchText"
                  md-search-text-change="searchTextChange(searchText)"
                  md-selected-item="selectedItem"
                  md-items="item in CallBackFilter(searchText)"
                  md-item-text="item.name"
                  placeholder="Escriba un autor">
                  <span md-highlight-text="searchText" md-highlight-flags="^i" >@{{item}}</span>
                </md-autocomplete>
              </div>
            </li>
            <li class="accordion-item is-active" data-accordion-item>
              <a href="#" class="accordion-title">Serie</a>
              <div class="accordion-content" data-tab-content>
                <select name="serie">
                  <option value ="all">Todas</option>
                  @foreach( $series as $serie)
                    <option value ="{{$serie->tid}}">{{ $serie->name }}</option>
                  @endforeach
               </select>
              </div>
            </li>
            <li class="accordion-item " data-accordion-item>
              <a href="#" class="accordion-title">País</a>
              <div class="accordion-content" data-tab-content>
                <input type="radio" name="country"  value="all" checked="checked" />Todos<br>
                @foreach ( $countrys as $country  )
                    <input type="radio" name="country" value="{{ $country->tid }}"> {{ $country->name }}<br>
                @endforeach
              </div>
            </li>
            <li class="accordion-item " data-accordion-item>
              <a href="#" class="accordion-title">Instrumento/Formato</a>
              <div class="accordion-content" data-tab-content>
                <input type="radio" name="instrument"  value="all" checked="checked" />Todos<br>
                @foreach ( $instruments as $instrument  )
                    <input type="radio" name="instrument" value="{{ $instrument->tid }}"> {{ $instrument->name }}<br>
                @endforeach
              </div>
            </li>
            <li class="accordion-item " data-accordion-item>
              <a href="#" class="accordion-title">Especifique un año:</a>
              <div class="accordion-content" data-tab-content>
                <md-slider-container>
                 <label>Especifique un año:</label>
                 <md-slider flex=""
                            min="1970"
                            max="2016"
                            ng-model="date.year"
                            aria-label="year"
                            id="year-slider"
                            class="medium-6 columns">
                 </md-slider>
               </md-slider-container>
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

             </div>
            </li>
          </ul>
        </div>
        <div class="field">
            <input type="submit" value="Buscar">
            <input type="reset" value="Borrar">
        </div>
      </form>
    </div>
  </div>
</div>
