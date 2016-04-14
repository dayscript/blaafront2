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
        $host = self::host();
        if($id_page == NULL){
            $nodes = self::_urlConstrucSearch($request,$host);
            $request->session()->put('searchItems', $nodes->view->path );
            var_dump($request->session()->get('searchItems'));
          }
        elseif( is_numeric($id_page) && $id_page != NULL ){
            $nodes = self::_urlConstrucSearch($request,$host,$id_page);
            $request->session()->put('searchItems', $nodes->view->path );
            var_dump($request->session()->get('searchItems'));
          }

         $instruments = self::_filterInstruments($host);
        $taxonomy = self::_filterCountries($host);
        $series = self::_filterSeries($host);
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
      $host = self::host();
      $instruments = self::_filterInstruments($host);
      $taxonomy = self::_filterCountries($host);
      $series = self::_filterSeries($host);
      return view('musica.index',compact('taxonomy','series','instruments'));
    }
    /*************************************************/
    /*Mustra json con las imagenes de conciertos Opus*/
    /*************************************************/
    public function ImgConcertsJson(){
      $path_img = env('PATH_IMG');
      $filesInFolder = File::allFiles('../'.$path_img);
      $files = [];
      $json = [];
      foreach($filesInFolder as $path ){
        $file = pathinfo($path);
        $files['nodes'][]['Imagen']['src'] = 'http://blaafront2.local/img/conciertos/'.$file['basename'];
      }
      $filesRandom=[];
      for( $i=0; $i <= 2;$i++ ){
        $filesRandom['nodes'][rand(1,count($files['nodes']))] = $files['nodes'][rand(1,count($files['nodes']))];
      }
      return response()->json($filesRandom);
    }
    /*********************************/
    /*Mustra detalle del nodo de Opus*/
    /*********************************/
    public function OpusConcertDetail($nid){
      $host = self::host();
      $instruments = self::_filterInstruments($host);
      $countrys = self::_filterCountries($host);
      $nodes = json_decode(file_get_contents($host.'detalle-nodos-opus/concierto/'.$nid));
      $titulo = explode(',',$nodes->nodes[0]->titulo);
      $nodes->nodes[0]->titulo = $titulo[1];
      /*Obtener Artistas*/
      $artistas = explode(',',$nodes->nodes[0]->artistas);
      if(is_array($artistas)){
          $items = [];
          foreach ($artistas as $key => $value) {
            $artistas[$key] = json_decode(file_get_contents($host.'detalle-nodo-opus/artista/'.$value));
          }

          $nodes->nodes[0]->artistas = $artistas;
      }
     $integrantes = explode(',',$nodes->nodes[0]->integrantes);
      if(is_array($integrantes)){
          $items = [];
          foreach ($integrantes as $key => $value) {
            $integrantes[$key] = json_decode(file_get_contents($host.'detalle-nodo-opus/integrante/'.$value));
          }
          $nodes->nodes[0]->integrantes = $integrantes;
      }

      $obras = explode(',',$nodes->nodes[0]->obras);

      if(is_array($obras)){
          $items = [];
          foreach ($obras as $key => $value) {
            $obras[$key] = json_decode(file_get_contents($host.'detalle-nodo-opus/obra/'.$value));
          }
          $nodes->nodes[0]->obras = $obras;

      }
      $node = $nodes->nodes[0];

      //dd($node);
      $nodesRelacionados = json_decode(file_get_contents($host.'detalle-de-contenido/node-relacionado/concert'));
      $nodeR = $nodesRelacionados->nodes;
      return view('musica.ConcertDetail', compact('node','nodeR'));
    }

}
