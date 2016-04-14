<!-- Dayscript 2016 all rigths reserved -->
<!-- Seccion Search for leftbar -->

<div class="medium-3 LeftBar columns LeftBar">
  <div class=" medium-12 search-detail">
    <h6 class="text-center">Realizar nueva búsqueda</h6>
    <form action="/musica" method="post">
      <input type="text" name="word_key" id="palabra_clave" placeholder="Busque por palabra">
      <div class="field">
          <input type="submit" value="buscar">
      </div>
    </form>
    <a href="/musica">Búsqueda Avanzada</a>
  </div>
  <div class= "medium-12">
   <div class="medium-12 search-similar ">
     <span class="text-center" >Resultados Similares</span>
   </div>
   <div class="medium-12">
     @foreach( $nodeR as $key => $value)
     <div class="node-related" style="background-image:url('{{ $value->imagen }}') ">
       <a>
         <div class="hover-info-related medium-12">
           <span class="">Otras Presentaciones de :<br>
           {{ $value->artistas}}</span>
        </div>
      </a>
     </div>
     @endforeach
   </div>
  </div>
</div>
