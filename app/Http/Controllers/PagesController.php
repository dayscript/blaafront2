<?php

/*Include*/
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class PagesController extends Controller
{

    public function __construnct(){
        $path = app_path();
        dd($path);
    }
    public function pruebas(){
      parent::__construct();
      print 'entro';
    }

    /*************************/
    /* Variables constantes  */
    /*************************/
    public function host(){
      return env('HOST');
    }

    /****************************************************/
    /*  retorna un string con los elementos de busqueda */
    /****************************************************/
    public function _itemSearch($request){
      $itemSearch="";
      foreach ($request->all() as $key => $value) {
            if($key != '_token'){
              if( $value !="" && $value !='all'){
                  $itemSearch .= $value.', ';
                }
              }
        }
        return $itemSearch;
    }

    /***************************************************/
    /*Permite construir la url par realizar la peticion*/
    /***************************************************/
    public function _urlConstrucSearch($request,$host,$id_page = NULL){
    # forma de la url
    # palabra clave/autor/compositor/pais/instrumentos
    $url = $host.'busqueda-de-contenido/conciertos';
    if($request->session()->get('searchItems') == NULL || $id_page == NULL){
      foreach ($request->all() as $key => $value) {
            if($key != '_token'){
              if( $value !=""){
                  $url .= '/'.str_replace(' ','%20',$value);
                }
                else{
                  $url .= '/all';
                  }
              }
        }
    }
    else{
      $url = $host.$request->session()->get('searchItems').'/?page='.$id_page;
      }

      //dd($url);
      $json = json_decode(file_get_contents($url));
      foreach ($json->nodes as $key => $value) {
        $title = explode(',',$value->titulo);
        $json->nodes[$key]->titulo = $title[1];
      }
      return $json;
    }
    /**************************************/
    /*Retorna todos los paises disponibles*/
    /**************************************/
    public function _filterCountries($host){
      $countryJson = json_decode(file_get_contents($host.'taxonomias/paises/json'));
      $countries = $countryJson->nodes;
      return $countries;
    }
    /********************************************/
    /*Retorna todos los instrumentos disponibles*/
    /********************************************/
    public function _filterInstruments($host){
      $instrumentJson = json_decode(file_get_contents($host.'taxonomias/instrumentos/json'));
      $instruments = $instrumentJson->nodes;
      return $instruments;
    }

    public function _filterSeries($host){
      $seriesJson = json_decode(file_get_contents($host.'taxonomias/series/json'));
      $series = $seriesJson->nodes;
      return $series;
    }

    /*********************************************/
    /*Retorna todos los resultados de la busqueda*/
    /*********************************************/
    public function OpusSearch(Request $request,$id_page=NULL){
        if($id_page == NULL){
            $nodes = self::_urlConstrucSearch($request,self::host());
            $request->session()->put('searchItems', $nodes->view->path );
            var_dump($request->session()->get('searchItems'));
          }
        elseif( is_numeric($id_page) && $id_page != NULL ){
            $nodes = self::_urlConstrucSearch($request,self::host(),$id_page);
            $request->session()->put('searchItems', $nodes->view->path );
            var_dump($request->session()->get('searchItems'));
          }

        $instruments = self::_filterInstruments(self::host());
        $taxonomy = self::_filterCountries(self::host());
        $series = self::_filterSeries(self::host());
        $itemSearch = self::_itemSearch($request);
        //dd($nodes);
        #redireccionar, si no se encuentran resultados
        if( count($nodes->nodes) <=0 )
          return Redirect::to('musica')->with('status', 'No se han encontrado coincidencias');
        #muestra los resultados
        return view('musica.search', compact('nodes','taxonomy','instruments','series','itemSearch'));
    }
    /**********************/
    /*Mustra index de Opus*/
    /**********************/
    public function OpusIndex(){
      $instruments = self::_filterInstruments(self::host());
      $taxonomy = self::_filterCountries(self::host());
      $series = self::_filterSeries(self::host());
      return view('musica.index',compact('taxonomy','series','instruments'));
    }
    /*************************************************/
    /*Mustra json con las imagenes de conciertos Opus*/
    /*************************************************/
    public function ImgConcertsJson(){
      $files = [];
      $json = [];
      $filesRandom=[];
      foreach( File::allFiles('../'.env('PATH_IMG')) as $path ){
        $files['nodes'][]['Imagen']['src'] = 'http://blaafront2.local/img/conciertos/'.pathinfo($path)['basename'];
      }
      for( $i=0; $i <= 2;$i++ ){
        $filesRandom['nodes'][$i] = $files['nodes'][rand(1,count($files['nodes'])-1)];
      }
      return response()->json($filesRandom);
    }
    /*********************************/
    /*Mustra detalle del nodo de Opus*/
    /*********************************/
    public function OpusConcertDetail($nid){
      $nodes = json_decode(file_get_contents(self::host().'detalle-nodos-opus/concierto/'.$nid));
      $titulo = explode(',',$nodes->nodes[0]->titulo);
      $nodes->nodes[0]->titulo = $titulo[1];

      /*Obtener Artistas*/
      $artistas = str_replace(' ','',implode('+',explode(',',$nodes->nodes[0]->artistas)));
      $artistas = json_decode(file_get_contents(self::host().'detalle-nodo-opus/artista/'.$artistas));

      foreach ($artistas->artista as $key => $value) {
        $artistasList[]['artista'] = $value;
      }
      $nodes->nodes[0]->artistas = $artistasList;

      $integrantes = str_replace(' ','',implode('+',explode(',',$nodes->nodes[0]->integrantes)));
      $integrantes = json_decode(file_get_contents(self::host().'detalle-nodo-opus/integrante/'.$integrantes));
      foreach ($integrantes->integrante as $key => $value) {
         $integrantesList[]['integrante'] = $value;
      }
      $nodes->nodes[0]->integrantes = $integrantesList;

      $obras = str_replace(' ','',implode('+',explode(',',$nodes->nodes[0]->obras)));
      $obras = json_decode(file_get_contents(self::host().'detalle-nodo-opus/obra/'.$obras));
      foreach ($obras->obra as $key => $value) {
        $obrasList[]['obra'] = $value;
      }
      $nodes->nodes[0]->obras = $obrasList;

      $node = $nodes->nodes[0];
      //dd($node);
      $nodesRelacionados = json_decode(file_get_contents(self::host().'detalle-de-contenido/node-relacionado/concert'));
      $nodeR = $nodesRelacionados->nodes;
      return view('musica.concertDetail', compact('node','nodeR'));
    }

}
