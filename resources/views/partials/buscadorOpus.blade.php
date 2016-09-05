<div class="medium-12 search">
    <div class="search">
        <div class="about"><a href="/musica/acerca-de-opus" class="acerca-de-opus">Acerca de Opus</a>  </div>
        <div class="searchlabel">Haga aquí su búsqueda
            utilizando uno o más criterios:
        </div>
        <div class="fields" ng-controller="SearchController" >
            <form action="/musica/resultados/0" method="post">
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
                      <option value="all">Todas</option>
                      <option ng-repeat="serie in series" value="@{{serie.tid}}" >@{{serie.name}}</option>
                    </select>
                   </div>
                    <div class="medium-12 input">
                    <label for="name">Pais</label>
                    <select  name="country">
                      <option value ="all">Todos</option>
                      <option ng-repeat ="pais in paises" value ="@{{pais.tid}}">@{{pais.name}}</option>
                    </select>
                    </div>
                    <div class="medium-12 input">
                    <label for="name">Instrumento/Formato</label>
                    <select name="instrument">
                      <option value ="all">Todos</option>
                      <option ng-repeat="instrumento in instrumentos" value ="@{{instrumento.tid}}">@{{instrumento.name}}</option>

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
                  </md-slider-container>
                  </div>
                </div>
                <div class="field medium-12">
                    <input type="submit" class="medium-12"  value="Buscar">
                    <input type="reset" class="medium-12"  value="Limpiar Filtros">
                </div>
            </form>
        </div>
    </div>
</div>
