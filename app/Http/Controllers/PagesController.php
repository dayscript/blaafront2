<?php

/*Include*/
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Drupal\DrupalServices;
use App\Http\InfoOrder\Order;


use App\Http\Controllers\Controller;
use File;

class PagesController extends Controller
{
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
    /*********************************************/
    /*Retorna todos los resultados de la busqueda*/
    /*********************************************/
    public function OpusSearch(Request $request,$id_page = NULL){
        $Params = new Order( Input::get() );
        $Params->changeOptions(array('orden'=>Input::get('orden')));
        //$Params->changeOptions(array('orden_crono'=>Input::get('orden_crono')));

        $Params->str_params();

        if($request->input('_token') != null){
            $request->session()->put('searchItems',NULL);
        }

        $request->session()->put('orden','Default');
        if( Input::get('orden') ){
           $request->session()->put('orden',Input::get('orden'));
        }

        /*numero de resultados por pagina*/
        if( Input::get('items') ){
          $request->session()->put('items',Input::get('items'));
        }
        elseif ( $request->session()->get('items') != NULL ){
          $request->session()->put('items',$request->session()->get('items'));
        }
        else{
          $request->session()->put('items',10);
        }

        $id_page = ( $id_page == NULL ) ? 0:$id_page;
        $query = new DrupalServices('all');
        $query->addHost( self::host() );
        $query->addGetParam( array( 'page'=> $id_page,'items'=> $request->session()->get('items') ));
        if( $request->session()->get('searchItems') == NULL  ){
            $query->addEndPoint( 'busqueda-de-contenido/conciertos' );
            $query->addParams($request->input('word_key'));
            $query->addParams($request->input('artist'));
            $query->addParams($request->input('composer'));
            $query->addParams($request->input('serie'));
            $query->addParams($request->input('country'));
            $query->addParams($request->input('instrument'));
            //$query->addGetParam(array( 'start'=>$request->input('start'),'end'=>$request->input('end')));
            $query->addParamsdate(array('start'=>$request->input('start'),'end'=>$request->input('end')));
            $request->session()->put('searchItems',$query->param );
            $query->execute();
            //dd($query->urlHttp);
        }else{
            $query->addEndPoint( 'busqueda-de-contenido/conciertos'.$request->session()->get('searchItems'));
            $query->execute();
            //dd($query->urlHttp);
        }
        $json = $query->execute;
        if($json == 'ERROR')
          return Redirect::to('musica')->with('status', 'se ha encontrado un error, vuelva a intentarlo mas tarde');

        foreach ( $json->nodes as $key => $value) {
          $title = explode(',',$value->titulo);
          $json->nodes[$key]->titulo = $title[1];
          $json->nodes[$key]->registro = $title[0];
        }
        #redireccionar, si no se encuentran resultados
        if( count($json->nodes) <=0 )
          return Redirect::to('musica')->with('status', 'No se han encontrado coincidencias');
        #muestra los resultados
        if( $request->session()->get('orden') != "Default" ){
          foreach( $json->nodes as $key =>$value ){
            $aux[$key] = $value->titulo;
          }
          ( $request->session()->get('orden') == 'asc' ) ? array_multisort($aux, SORT_ASC, $json->nodes) : array_multisort($aux, SORT_DESC, $json->nodes);

          $nodes = $json;
        }
        else{
          $nodes = $json;
        }

        $itemSearch = self::_itemSearch($request);
        $nodesjs = json_encode($nodes);
        //dd($nodes);
        return view('musica.search', compact('nodes','itemSearch','nodesjs','Params'));

    }
    /**********************/
    /*Mustra index de Opus*/
    /**********************/
    public function OpusIndex(Request $request){

      return view('musica.index');
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
        $files[] = env('SERVER_URL').'/img/conciertos/'.pathinfo($path)['basename'];
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
      $nodes->nodes[0]->registro = $titulo[0];
      $integrantes = [];
      /*Obtener Artistas*/
      $artistas = str_replace(' ','',implode('+',explode(',',$nodes->nodes[0]->artistas)));
      $artistas = json_decode(file_get_contents(self::host().'detalle-nodo-opus/artista/'.$artistas));
      foreach ($artistas->artista as $key => $value) {
        $value->titulo = trim(substr($value->titulo,7));
        $artistasList[]['artista'] = $value ;
        $integrantes[] = ( $value->integrante != "" ) ? $value->integrante : 0 ;
      }
      $nodes->nodes[0]->artistas = $artistasList;

      $integrantes = str_replace(',','+',str_replace(' ','',implode('+',$integrantes)));
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

    /***************************************/
    /*Mustra detalle del nodo de Acerca de**/
    /***************************************/

      public function AcercaDe(){
        return view('musica.paginaBasica');
      }

}
