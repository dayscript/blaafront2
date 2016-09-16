<?php

namespace App\Http\InfoOrder;

class Order {

  public function __construct( $params = array() ) {
    $this->info = 'Para organizar los parametros';
    $this->params = $params;
  }

   public function changeOptions( $options = array() ){

      $this->changeOptions = $options;

      foreach ($this->changeOptions as $key => $value) {
        if( $key == "orden" && array_key_exists($key,$this->params)){
          switch ($this->changeOptions[$key]) {
            case 'asc':
              $this->params[$key] = 'desc';
            break;
            case 'desc':
              $this->params[$key] = 'asc';
            break;
            default:
              $this->params[$key] = 'asc';
            break;
          }
        }elseif( $key == "orden_crono" && array_key_exists($key,$this->params)){
          switch ($this->changeOptions[$key]) {
            case 'asc':
              $this->params[$key] = 'desc';
            break;
            case 'desc':
              $this->params[$key] = 'asc';
            break;
            default:
              $this->params[$key] = 'asc';
            break;
          }
        }
        else{ 
          $this->params[$key] = 'asc';
        }
      }
  }
  public function str_params(){
    $str_params = '?';
    foreach ($this->params as $key => $value) {
        $str_params .= $key.'='.$value.'&';
    }
    $this->str_params = $str_params;
  }

}
