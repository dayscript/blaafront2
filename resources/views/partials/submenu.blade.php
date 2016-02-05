<!--Menu seccion-->

<nav class="subMenu large-12 {{ isset($menu[Request::path()])? $menu[Request::path()]['style']:'' }}" >
    <div class="subContent large-12">

        <div class="large-8 columns"><h2><span>{{ isset($menu[Request::path()])? $menu[Request::path()]['title']:'' }}</span>
                <em>\{{ isset($menu[Request::path()])? $menu[Request::path()]['subtitle']:'' }}</em></h2></div>
        <div class="lFiltro large-4 columns">
            <select class="customSelect">
                <option>BOGOTÁ</option>
                <option>CALI</option>
                <option>MEDELLÍN</option>
                <option>ARMENIA</option>
                <option>PEREIRA</option>
                <option>MANIZALES</option>
                <option>IBAGUÉ</option>
            </select>
        </div>
    </div>
    <ul class="menu">
        @if(isset($menu[Request::path()]['options']))
            @foreach($menu[Request::path()]['options'] as $url=>$suboption)
                <li><a href="{{ $url }}" class="{{ Request::is($url)?'active':'' }}"><span>{{ $suboption['label'] }}</span></a></li>
            @endforeach
        @endif
                        <!--<li><a href="#"><span>CONTACTOS</span></a></li>-->
                <!--<li><a href="#"><span>LISTAS DE CORREO</span></a></li>-->
                <!--<li><a href="#"><span>REDES SOCIALES</span></a></li>-->
                <!--<li><a href="#"><span>PUBLICACIONES A LA VENTA</span></a></li>-->
                <!--<li><a href="#"><span>PRENSA</span></a></li>-->
                <!--<li><a href="#"><span>BLOG DE NOTICIAS</span></a></li>-->
    </ul>
</nav>
<!--Fin menu seccion-->