<div class="paginator row columns">
    <div class="medium-3 items-search columns">
        <label class="medium-12">{{$itemSearch}}</label>
        <label class="medium-12 red"><strong>{{$nodes->view->count}}</strong> Resultados</label>
    </div>
    <div class="medium-3 columns number-items">
        <span>Resultados</span>
        <select id="number-items" onchange=" this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value); ">
          <option value="musica/opus/resultados/0?items=10">10</option>
          <option value="musica/opus/resultados/0?items=20">20</option>
          <option value="musica/opus/resultados/0?items=30">30</option>
          <option value="musica/opus/resultados/0?items=40">40</option>
          <option value="musica/opus/resultados/0?items=50">50</option>
        </select>
    </div>
    <div class="medium-3 columns">
      <div class="row order-by">
          <div class="medium-4 columns text-left">
              <label>Ordenar:   </label>
          </div>
       <div class="medium-4 columns text-right">
           <a href="{{Request::path().$Params->str_params}}elim=crono" id="order-by"></a>
       </div>
          <div class="medium-4 columns text-right">
              <a href="{{Request::path().$Params->str_params}}elim=orden" id="crono-by"></a>
          </div>
      </div>
    </div>
    <div class="medium-3 columns number-page">
        <ul class="pagination" role="menubar" aria-label="Pagination">
          <li class="arrow unavailable" aria-disabled="true"><a href="musica/opus/resultados/{{ $nodes->view->page-1 }}">&laquo; </a></li>
          @for( $i = $nodes->view->page+1 ; $i <= $nodes->view->pages; $i++ )
              @if( $i <= $nodes->view->page+3)
                    <li class="{{ ($nodes->view->page+1 == $i ) ? 'current':'' }}"><a href="/musica/opus/resultados/{{$i-1}}">{{$i}}</a></li>
              @endif
          @endfor
          @if( $nodes->view->page+1 < $nodes->view->pages)
            <li class="arrow"><a href="musica/opus/resultados/{{ $nodes->view->pages-1 }}">... {{ $nodes->view->pages }}</a></li>
          @endif


          <li class="arrow"><a href="musica/opus/resultados/{{ $nodes->view->page+1 }}"> &raquo;</a></li>
        </ul>
      </div>
</div>
