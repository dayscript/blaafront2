<div class="{{ Request::is('musica/opus*') ? 'medium-4' : 'medium-4' }} columns search">
    <div class="search">
        <div class="about"><a href="/musica/opus/acerca-de-opus" class="acerca-de-opus">Acerca de Opus</a>
          <span class="medium-12 lastupdate" ng-controller="LastUpdateController">
              Última actualización : @{{lastUpdate}}
          </span>
         </div>
        <div class="searchlabel">Haga aquí su búsqueda
            utilizando uno o más criterios:
        </div>
        <div class="fields" ng-controller="SearchController" >
            <form action="/musica/opus/resultados/0" method="post">
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
                        placeholder="Escriba nombre de un artista">
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
                      placeholder="Escriba nombre de un compositor">
                      <span md-highlight-text="searchText" md-highlight-flags="^i" >@{{composer}}</span>
                    </md-autocomplete>
                    </div>
                    <div class="medium-12 input">
                    <label for="name">Serie</label>
                    <select name="serie">
                      <option value="all">Todas</option>
                      <option ng-repeat="serie in series" value="@{{serie.name}}" >@{{serie.name}}</option>
                    </select>
                   </div>
                    <div class="medium-12 input">
                    <label for="name">Pais</label>
                    <select  name="country">
                      <option value ="all">Todos</option>
                      <option ng-repeat ="pais in paises" value ="@{{pais.name}}">@{{pais.name}}</option>
                    </select>
                    </div>
                    <div class="medium-12 input">
                    <label for="name">Instrumento/Formato</label>
                    <select name="instrument">
                      <option value ="all">Todos</option>
                      <option ng-repeat="instrumento in instrumentos" value ="@{{instrumento.name}}">@{{instrumento.name}}</option>

                   </select>
                   </div>
                   <div class="medium-12 input">
                     <div class="medium-6 columns range-date ">
                        <label>Desde</label>
                        <select name="start" name="select">
                          <option ng-repeat="val in years track by $index" value="@{{val}}">@{{val}}</option>
                        </select>
                        <!--<input name="start" type="datetime" date-time ng-model="start" format="YYYY" view="year" min-view="year" max-view="year">-->
                      </div>
                      <div class="medium-6 columns range-date">
                         <label>Hasta</label>
                         <select name="end" name="select">
                           <option ng-selected="val == 2016" ng-repeat="val in years track by $index" value="@{{val}}">@{{val}}</option>
                         </select>
                        <!--<input name="end" type="datetime" date-time ng-model="end" view="year" format="YYYY" min-view="year" max-view="year">-->
                      </div>
                  </div>
                </div>
                <div class="field medium-12">
                    <input type="submit" class="medium-6 columns"  value="Buscar">
                    <input type="reset" class="medium-6 columns"  value=" Limpiar Filtros">
                </div>
            </form>
        </div>
    </div>
</div>
