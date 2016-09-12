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
                        'url'   => '/musica/opus',
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
                        'url'   => 'http://www.banrepcultural.org/programacion-nacional-de-conciertos/all',
                        /*'suboptions'=>[
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
                        ]*/
                    ],
                    'programacion bogota'      => [
                        'label' => 'programación bogotá',
                        'url'   => 'http://www.banrepcultural.org/musica/temporada-nacional-de-conciertos',
                        'suboptions'=>[
                            'musica antigua'=>[
                                'label' => 'música antigua',
                                'url'   => 'http://www.banrepcultural.org/musica/temporada-nacional-de-conciertos/Música-antigua-para-nuestro-tiempo'
                            ],
                            'musica de camara'=>[
                                'label' => 'música de camara',
                                'url'   => 'http://www.banrepcultural.org/musica/temporada-nacional-de-conciertos/Recorridos-por-la-m%C3%BAsica-de-c%C3%A1mara'
                            ],
                            'retratos de un compositor'=>[
                                'label' => 'retratos de un compositor',
                                'url'   => 'http://www.banrepcultural.org/musica/temporada-nacional-de-conciertos/Retratos-de-un-compositor'
                            ],
                            'musica del mundo'=>[
                                'label' => 'música el mundo',
                                'url'   => 'http://www.banrepcultural.org/musica/temporada-nacional-de-conciertos/M%C3%BAsica-y-m%C3%BAsicos-de-Latinoam%C3%A9rica-y-el-mundo'
                            ],
                            'jóvenes intérpretes'=>[
                                'label' => 'jóvenes intérpretes',
                                'url'   => 'http://www.banrepcultural.org/musica/temporada-nacional-de-conciertos/Serie-de-los-j%C3%B3venes-int%C3%A9rpretes'
                            ],
                            'la música en familia'=>[
                                'label' => 'la música en familia',
                                'url'   => 'http://www.banrepcultural.org/musica/temporada-nacional-de-conciertos/La-m%C3%BAsica-en-familia'
                            ],
                            'la música se habla'=>[
                                'label' => 'la música se habla',
                                'url'   => 'http://www.banrepcultural.org/musica/la-musica-se-habla'
                            ],
                            'conciertos didácticos'=>[
                                'label' => 'conciertos didácticos',
                                'url'   => 'http://www.banrepcultural.org/musica/conciertos-didacticos'
                            ],
                        ]
                    ],
                    'musica/lasala'       => [
                        'label' => 'La sala',
                        'url'   => 'http://www.banrepcultural.org/musica/descripcion-de-la-sala',
                        'suboptions'=>[
                            'boleteria'=>[
                                'label' => 'boletería',
                                'url'   => 'http://www.banrepcultural.org/musica/boleteria'
                            ],
                            'rutas de acceso y servicios'=>[
                                'label' => 'rutas acceso y servicios',
                                'url'   => 'http://www.banrepcultural.org/musica/rutas-de-accesos-y-servicios'
                            ],
                            'tome nota'=>[
                                'label' => 'tome nota',
                                'url'   => 'http://www.banrepcultural.org/musica/tome-nota'
                            ],
                            'descripcion de la sala'=>[
                                'label' => 'descripcíon de la sala',
                                'url'   => 'http://www.banrepcultural.org/musica/descripcion-de-la-sala'
                            ],
                        ]
                    ],
                    'publicaciones y sus colecciones'  => [
                        'label' => 'publicaciones y sus colecciones',
                        'url'   => 'http://www.banrepcultural.org/musica/grabaciones',
                        /*'suboptions'=>[
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
                        ]*/
                    ],
                    'cómo presentar su propuesta artistica'    => [
                        'label' => 'cómo presentar su propuesta artistica',
                        'url'   => 'http://www.banrepcultural.org/musica/presentacion-propuesta-artistica',
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
                    /*'/musica/info'        => [
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
                        ],
                    ],*/
                ],
            ],
        ];
        $seccion = explode('/',Request::path());
        $this->menu['submenu'] = $this->menu['menu'][$seccion[0]];
        view()->share('menu',$this->menu);
    }

}
