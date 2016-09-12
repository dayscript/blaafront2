<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
    //return Redirect::to('/opus');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('musica/opus', 'PagesController@OpusIndex');
    Route::post('musica/opus', 'PagesController@OpusSearch');
    Route::get('musica/opus/resultados/{id_page}', 'PagesController@OpusSearch');
    Route::post('musica/opus/resultados/{id_page}', 'PagesController@OpusSearch');
    Route::get('musica/opus/concierto/{nid}', 'PagesController@OpusConcertDetail');
    Route::get('musica/conciertos/img/json', 'PagesController@ImgConcertsJson');
    Route::get('musica/opus/acerca-de-opus', 'PagesController@AcercaDe');
    Route::get('musica/opus/pruebas', 'PagesController@pruebas');


}); 

