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
    public function addGetParam( $array = NULL ){
      if( is_array($array) ){
        $this->getParams = http_build_query($array);
      }
    }
    public function addParams($param){
      $url = "";
      $urlTest = "";

      if( $param !=""){
          $url .= '/'.str_replace(' ','%20',$param);
        }
        else{
            $url .= '/'.$this->Word;
          }
      $this->param .= $url;
    }

    public function execute(){
      $this->urlHttp = $this->host.$this->endPoint.$this->param.'?'.$this->getParams;
      var_dump($this->urlHttp);
      try {
        $this->execute = json_decode(file_get_contents( $this->urlHttp ));
      } catch(\Exception $e) {
        $this->execute = 'ERROR';
      }
    }
}
