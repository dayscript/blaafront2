<?php

/*******************************************************/
/*Genera clases dependiendo de la utl para las paginas */
/*******************************************************/
  function get_css_class_for_page($type){
    $array = ['nid','token'];
      $paths = Request::route();
      $path = $paths->uri();
      $cssClass = implode(' ',explode('/',$path));
      foreach ($array as $value) {
        if(preg_match('/(\W|^)({'.$value.'})(\W|$)/',$path)){
            $path = str_replace($value,$paths->parameters()[$value],$path);
        }
      }
    $path = clean_character($path);
    $cssClass = clean_character($cssClass,'page');
    return $cssClass.' '.$type.'-'.$path;
  }

  /*****************************************************/
  /*Permite limpiar las clases de caracteres extraños  */
  /*****************************************************/
  function clean_character($path,$type = NULL){
    $path = str_replace('{','',$path);
    $path = str_replace('}','',$path);
    $path = str_replace('/','-',$path);

    if( !is_null($type) ){
      $path = explode(" ",$path);
      foreach ($path as $key => $value) {
        $return[] = $type.'-'.$value;
      }
      $path = implode(" ",$return);
    }

    return $path;
  }

/***********************************************************/
/*Asigna clases al menu principal dependiendo de la seccion*/
/***********************************************************/
function get_class_for_menu($seccion = NULL){
  if( !is_null($seccion) ){
    $seccion = explode('/',$seccion);
    return $seccion[0];
  }
}

/*********************/
/* Define url activa */
/*********************/
function url_is_active($url = NULL, $menu = NULL){
  if( !is_null($url) ){
    if( strpos(strtolower($url),$menu) !== false ){
        return 'active';
    }
  }
}
