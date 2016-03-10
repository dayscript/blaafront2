<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function host(){
      return env('HOST');
    }

    public function _urlConstrucSearch($request,$host){
      $url = $host.'busqueda-de-contenido/conciertos';
      foreach ($request->all() as $key => $value) {
            if($key != '_token'){
              if( $value !=""){
                  $url .= '/'.$value;
              }
              else{
                $url .= '/all';
              }
            }
      }
      
      $json = json_decode(file_get_contents($url));
      $nodes = $json->nodes;

      foreach ($nodes as $key => $value) {
        $title = explode('-',$value->Título);
        $nodes[$key]->Título = $title[2];
      }
      return $nodes;
    }

    public function _filterCountries($host){
      $countryJson = json_decode(file_get_contents($host.'taxonomias/paises/json'));
      $countries = $countryJson->nodes;
      return $countries;
    }

    public function _filterInstruments($host){
      $instrumentJson = json_decode(file_get_contents($host.'taxonomias/instrumentos/json'));
      $instruments = $instrumentJson->nodes;
      return $instruments;
    }

    public function OpusSearch(Request $request){
        $host = self::host();
        $nodes = self::_urlConstrucSearch($request,$host);
        $instruments = self::_filterInstruments($host);
        $countrys = self::_filterCountries($host);
        return view('musica.search', compact('nodes','countrys','instruments'));
    }

    public function OpusIndex(){
      $host = self::host();
      $instruments = self::_filterInstruments($host);
      $taxonomy = self::_filterCountries($host);
      return view('musica.index',compact('taxonomy','instruments'));
    }
    public function OpusConcertDetail($nid){

      $host = self::host();
      $instruments = self::_filterInstruments($host);
      $countrys = self::_filterCountries($host);
      $nodes = json_decode(file_get_contents($host.'detalle-de-contenido/concert/'.$nid));
      $node = $nodes->nodes;
      $obras = explode('|',$node[0]->obras);
      $nodesRelacionados = json_decode(file_get_contents($host.'detalle-de-contenido/node-relacionado/concert'));
      $nodeR = $nodesRelacionados->nodes;

      return view('musica.ConcertDetail', compact('node','nodeR','obras','countrys','instruments'));
    }

}
