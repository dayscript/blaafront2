<?php

/*Include*/
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Drupal\DrupalServices;

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
    public function OpusSearch(Request $request,$id_page = NULL){
        if($request->input('_token') != null){
          $request->session()->put('searchItems',NULL);
        }
        $items = (  Input::get('items') ) ? Input::get('items'):10;
        $id_page = ( $id_page == NULL ) ? 0:$id_page;
        $query = new DrupalServices('all');
        $query->addHost( self::host() );
        $query->addGetParam( array( 'page'=> $id_page,'items'=> $items ));
        if( $request->session()->get('searchItems') == NULL  ){
          $query->addEndPoint( 'busqueda-de-contenido/conciertos' );
          $query->addParams($request->input('word_key'));
          $query->addParams($request->input('artist'));
          $query->addParams($request->input('composer'));
          $query->addParams($request->input('serie'));
          $query->addParams($request->input('country'));
          $query->addParams($request->input('instrument'));
          $query->addParams($request->input('year'));
          $query->execute();
          $request->session()->put('searchItems', $query->param );
        }else{
          $query->addEndPoint( 'busqueda-de-contenido/conciertos'.$request->session()->get('searchItems') );
          $query->execute();
        }

        $json = $query->execute;
        foreach ( $json->nodes as $key => $value) {
          $title = explode(',',$value->titulo);
          $json->nodes[$key]->titulo = $title[1];
        }
        $nodes = $json;
        $instruments = self::_filterInstruments(self::host());
        $taxonomy = self::_filterCountries(self::host());
        $series = self::_filterSeries(self::host());
        $itemSearch = self::_itemSearch($request);
        #redireccionar, si no se encuentran resultados
        if( count($nodes->nodes) <=0 )
          return Redirect::to('musica')->with('status', 'No se han encontrado coincidencias');
        #muestra los resultados
        return view('musica.search', compact('nodes','taxonomy','instruments','series','itemSearch'));
    }
    /**********************/
    /*Mustra index de Opus*/
    /**********************/
    public function OpusIndex(Request $request){
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
      $temp = [];

      $filesRandom=[];
      foreach( File::allFiles('../'.env('PATH_IMG')) as $path ){
        $files[] = 'http://blaafront2.demodayscript.com/img/conciertos/'.pathinfo($path)['basename'];
      }
      $h=0;
      while( $h <= 5 ){
        $rand = rand(1,count($files)-1);
        if( !array_key_exists($rand,$filesRandom) ){
            $filesRandom[$rand] = $files[$rand];
            $h++;
        }
      }
      return response()->json($filesRandom);
    }
    /*********************************/
    /*Muestra detalle del nodo de Opus*/
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

      if(isset($integrantes->integrante[0])){
        foreach ($integrantes->integrante as $key => $value) {
           $integrantesList[]['integrante'] = $value;
        }
      }else{
        $integrantesList[] = 'Undefined';
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

    /*********************************/
    /*Mustra detalle del nodo de Acerca de*/
    /*********************************/

      public function AcercaDe(){
        return view('musica.paginaBasica');
      }

}
