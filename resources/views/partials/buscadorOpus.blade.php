<div class="{{ Request::is('musica/*') ? 'medium-12' : 'medium-4' }} columns search">
    <div class="search">
        <div class="about"><a href="/musica/acerca-de-opus" class="acerca-de-opus">Acerca de Opus</a>
          <span class="medium-12 lastupdate"ng-controller="LastUpdateController">
              Última actualización : @{{lastUpdate}}
          </span>
         </div>
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
                     <div class="medium-6 columns range-date ">
                        <label>Desde</label>
                        <input name="start" class="date-range" type="datetime" date-time ng-model="en" format="YYYY" view="year" min-view="year" max-view="year">
                        <!--<div date-picker="start" min-view="date"></div>-->
                      </div>
                      <div class="medium-6 columns range-date">
                         <label>Hasta</label>
                        <input name="end" type="datetime" date-time ng-model="end" view="year" format="YYYY" min-view="year" max-view="year">
                      </div>
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
