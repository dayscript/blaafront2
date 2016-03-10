<!-- Dayscript 2016 all rigths reserved -->
<!-- Seccion Search for facets -->
<div class="columns medium-4">
  <div class="search" ng-controller="SearchController">
      <div class="  medium-12">
          <span>Filtre su busqueda por:</span>
      </div>
      <form action="/musica" method="post" >
        {{ csrf_field() }}
        <div class=" medium-12 filter-accordion ng-controller="SearchController" ">
          <ul class="accordion" data-accordion >
            <li class="accordion-item is-active" data-accordion-item>
              <a href="#" class="accordion-title">Serie</a>
              <div class="accordion-content" data-tab-content>
                @foreach ( $countrys as $country  )

                @endforeach
              </div>
            </li>
            <li class="accordion-item" data-accordion-item>
              <a href="#" class="accordion-title">Artista</a>
              <div class="accordion-content" data-tab-content>
                <md-autocomplete
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
              <a href="#" class="accordion-title">País</a>
              <div class="accordion-content" data-tab-content>
                @foreach ( $countrys as $country  )
                    <input type="checkbox" name="country" value="{{ $country->tid }}"> {{ $country->name }}<br>
                @endforeach
              </div>
            </li>
            <li class="accordion-item " data-accordion-item>
              <a href="#" class="accordion-title">Instrumento/Formato</a>
              <div class="accordion-content" data-tab-content>
                @foreach ( $instruments as $instrument  )
                    <input type="checkbox" name="instrument" value="{{ $instrument->tid }}"> {{ $instrument->name }}<br>
                @endforeach
              </div>
            </li>
            <li class="accordion-item " data-accordion-item>
              <a href="#" class="accordion-title">Compositor</a>
              <div class="accordion-content" data-tab-content>
                <md-autocomplete
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
          </ul>
        </div>
        <div class="field">
            <input type="submit" value="buscar">
        </div>
      </form>
    </div>
</div>
