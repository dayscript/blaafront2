<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $menu;

    public function __construct()
    {
        $this->menu = [
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
                    'musica/temporada'    => [
                        'label' => 'Temporada nacional de conciertos',
                        'url'   => 'musica/temporada'
                    ],
                    'musica/programacion' => [
                        'label' => 'Programación académica',
                        'url'   => 'musica/programacion'
                    ],
                    'musica/jovenes'      => [
                        'label' => 'Convocatoria jóvenes intérpretes',
                        'url'   => 'musica/jovenes'
                    ],
                    'musica/lasala'       => [
                        'label' => 'La sala',
                        'url'   => 'musica/lasala'
                    ],
                    '/musica/especiales'  => [
                        'label' => 'Programas especiales',
                        'url'   => '/musica/especiales'
                    ],
                    'musica/boleteria'    => [
                        'label' => 'Boletería',
                        'url'   => 'musica/boleteria'
                    ],
                    '/musica/info'        => [
                        'label' =>
                            'Información práctica',
                        'url'   => 'musica/info'
                    ]
                ]
            ],
            'musica/concierto/'      => [
                'label'    => 'Música',
                'title'    => 'Opus',
                'subtitle' => 'Histórico de conciertos del Banco de la República',
                'url'      => 'musica',
                'style'    => 'cMusica',
                'options'  => [
                    'musica/temporada'    => [
                        'label' => 'Temporada nacional de conciertos',
                        'url'   => 'musica/temporada'
                    ],
                    'musica/programacion' => [
                        'label' => 'Programación académica',
                        'url'   => 'musica/programacion'
                    ],
                    'musica/jovenes'      => [
                        'label' => 'Convocatoria jóvenes intérpretes',
                        'url'   => 'musica/jovenes'
                    ],
                    'musica/lasala'       => [
                        'label' => 'La sala',
                        'url'   => 'musica/lasala'
                    ],
                    '/musica/especiales'  => [
                        'label' => 'Programas especiales',
                        'url'   => '/musica/especiales'
                    ],
                    'musica/boleteria'    => [
                        'label' => 'Boletería',
                        'url'   => 'musica/boleteria'
                    ],
                    '/musica/info'        => [
                        'label' =>
                            'Información práctica',
                        'url'   => 'musica/info'
                    ]
                ]
            ]
        ];
        view()->share('menu',$this->menu);
    }

}
