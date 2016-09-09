<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $menu;

    public function __construct()
    {
        $this->menu['menu'] = [
            '/' => [
                'url'      => 'http://www.banrepcultural.org/',
                'label'    => 'Actividad cultural<br>del Banco de la<br>República',
                'title'    => 'Actividad cultural',
                'subtitle' => 'Banco de la República',
                'style'    => 'cIndex'
            ],
            'areas'       => [
                'label'    => 'Áreas<br>culturales<br>en el país',
                'title'    => 'Áreas culturales en el país',
                'subtitle' => 'Banco de la República',
                'url'      => 'http://www.banrepcultural.org/areas-culturales',
                'style'    => 'cAreas'
            ],
            'arte'        => [
                'label'    => 'Arte y<br>numismática',
                'title'    => 'Arte y numismática',
                'subtitle' => 'Banco de la República',
                'url'      => 'http://www.banrepcultural.org/museos-y-colecciones',
                'style'    => 'cArte'
            ],
            'bibliotecas' => [
                'label'    => 'Bibliotecas',
                'title'    => 'Bibliotecas',
                'subtitle' => 'Banco de la República',
                'url'      => 'http://www.banrepcultural.org/blaa',
                'style'    => 'cBiblio'
            ],
            'bvirtual'    => [
                'label'    => 'BVirtual',
                'title'    => 'BVirtual',
                'subtitle' => 'Banco de la República',
                'url'      => 'http://www.banrepcultural.org/blaavirtual/indice',
                'style'    => 'cBvirtual'
            ],
            'museo'       => [
                'label'    => 'Museo<br>del Oro',
                'title'    => 'Museo del Oro',
                'subtitle' => 'Banco de la República',
                'url'      => 'http://www.banrepcultural.org/museo-del-oro',
                'style'    => 'cMuseo'
            ],
            'musica'      => [
                'label'    => 'Música',
                'title'    => 'Opus',
                'subtitle' => 'Histórico de conciertos del Banco de la República',
                'url'      => 'musica',
                'style'    => 'cMusica',
                'options'  => [
                    'inicio'    => [
                        'label' => 'inicio',
                        'url'   => '/musica',
                        /*'suboptions'=>[
                            'Uno'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Dos'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Tres'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Cuatro'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Cinco'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                        ]*/
                    ],
                    'programacion nacional' => [
                        'label' => 'Programación nacional',
                        'url'   => 'musica/programacion',
                        'suboptions'=>[
                            'armenia'=>[
                                'label' => 'armenia',
                                'url'   => 'musica/temporada'
                            ],
                            'barranquilla'=>[
                                'label' => 'barranquilla',
                                'url'   => 'musica/temporada'
                            ],
                            'bucaramanga'=>[
                                'label' => 'bucaramanga',
                                'url'   => 'musica/temporada'
                            ],
                            'cartagena'=>[
                                'label' => 'cartagena',
                                'url'   => 'musica/temporada'
                            ],
                            'cali'=>[
                                'label' => 'cali',
                                'url'   => 'musica/temporada'
                            ],
                        ]
                    ],
                    'programacion bogota'      => [
                        'label' => 'programación bogotá',
                        'url'   => 'musica/jovenes',
                        'suboptions'=>[
                            'musica de camara'=>[
                                'label' => 'musica de camara',
                                'url'   => 'musica/temporada'
                            ],
                            'retratos de un compositor'=>[
                                'label' => 'retratos de un compositor',
                                'url'   => 'musica/temporada'
                            ],
                            'musica del mundo'=>[
                                'label' => 'música el mundo',
                                'url'   => 'musica/temporada'
                            ],
                            'jóvenes intérpretes'=>[
                                'label' => 'jóvenes intérpretes',
                                'url'   => 'musica/temporada'
                            ],
                            'la música en familia'=>[
                                'label' => 'la música en familia',
                                'url'   => 'musica/temporada'
                            ],
                        ]
                    ],
                    'musica/lasala'       => [
                        'label' => 'La sala',
                        'url'   => 'musica/lasala',
                        'suboptions'=>[
                            'boleteria'=>[
                                'label' => 'boletería',
                                'url'   => 'musica/temporada'
                            ],
                            'rutas de acceso y servicios'=>[
                                'label' => 'rutas acceso y servicios',
                                'url'   => 'musica/temporada'
                            ],
                            'tome nota'=>[
                                'label' => 'tome nota',
                                'url'   => 'musica/temporada'
                            ],
                            'descripcion de la sala'=>[
                                'label' => 'descripcíon de la sala',
                                'url'   => 'musica/temporada'
                            ],
                        ]
                    ],
                    'publicaciones y sus colecciones'  => [
                        'label' => 'publicaciones y sus colecciones',
                        'url'   => '/musica/especiales',
                        'suboptions'=>[
                            'grabaciones'=>[
                                'label' => 'grabaciones',
                                'url'   => 'musica/temporada'
                            ],
                            'retratos de un compositor'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Tres'=>[
                                'label' => 'adas para cuento de cuerdas',
                                'url'   => 'musica/temporada'
                            ],
                            'Cuatro'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Cinco'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                        ]
                    ],   
                    'cómo presentar su propuesta artistica'    => [
                        'label' => 'cómo presentar su propuesta artistica',
                        'url'   => 'musica/boleteria',
                        /*'suboptions'=>[
                            'Uno'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Dos'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Tres'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Cuatro'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Cinco'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                        ]*/
                    ],
                    '/musica/info'        => [
                        'label' => 'Información práctica',
                        'url'   => 'musica/info',
                        'suboptions'=>[
                            'Uno'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Dos'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Tres'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Cuatro'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                            'Cinco'=>[
                                'label' => 'Temporada nacional de conciertos',
                                'url'   => 'musica/temporada'
                            ],
                        ]
                    ]
                ]
            ],
        ];
        $seccion = explode('/',Request::path());
        $this->menu['submenu'] = $this->menu['menu'][$seccion[0]];
        view()->share('menu',$this->menu);
    }

}
