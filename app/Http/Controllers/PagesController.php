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

    public function musica()
    {
        $host = self::host();
        $json = json_decode(file_get_contents($host.'conciertos/json'));
        $nodes = $json->nodes;
        return view('musica.index', compact('nodes'));
    }
    public function opussearch(Request $request)
    {
        $host = self::host();
        $json = json_decode(file_get_contents($host.'buscar/'.$request->get('name')));
        $nodes = $json->nodes;
        dd($nodes);
        return view('musica.index', compact('nodes'));
    }

    public function search()
    {
      $host = self::host();
      $countryJson = json_decode(file_get_contents($host.'taxonomias/paises/json'));
      $instrumentJson = json_decode(file_get_contents($host.'taxonomias/instrumentos/json'));

      $taxonomy = $countryJson->nodes;
      $instruments = $instrumentJson->nodes;

      return view('musica.search',compact('taxonomy','instruments'));
    }
}
