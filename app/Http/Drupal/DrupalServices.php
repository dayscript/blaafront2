<?php

namespace App\Http\Drupal;

class DrupalServices {

  public function __construct( $word = NULL )
    {
      $this->Word = $word;
      $this->param = "";
      $this->urlHttp = "";
      $this->getParams ="/?";
    }

    public function addHost($host){
      $this->host = $host;
    }
    public function addEndPoint($endPoint){
      $this->endPoint = $endPoint;
    }
    public function addPageParam($id_page = NULL){
      if($id_page != NULL){
        $this->page = '/?page='.$id_page;
      }else{
        $this->page='';
      }
    }
    public function addGetParam( $array = NULL ){
      if( is_array($array) ){
          foreach ($array as $key => $value) {
            $this->getParams .=$key.'='.$value.'&';
          }
      }
    }
    public function addParams($param){
      $url = "";
      if( $param !=""){
          $url .= '/'.str_replace(' ','%20',$param);
        }
        else{
            $url .= '/'.$this->Word;
          }
      $this->param .= $url;
    }

    public function execute(){
      $this->urlHttp = $this->host.$this->endPoint.$this->param.$this->getParams;
      $this->execute = json_decode(file_get_contents( $this->urlHttp ));
      var_dump($this->urlHttp);
    }
}
