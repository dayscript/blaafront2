<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function musica()
    {
        $json = json_decode(file_get_contents('http://blaa.demodayscript.com/conciertos/json'));
        $nodes = $json->nodes;
        return view('musica.index', compact('nodes'));
    }
    public function opussearch()
    {
        $json = json_decode(file_get_contents('http://blaa.demodayscript.com/conciertos/json'));
        $nodes = $json->nodes;
        return view('musica.index', compact('nodes'));
    }

    public function search()
    {
        return view('musica.search');
    }
}
