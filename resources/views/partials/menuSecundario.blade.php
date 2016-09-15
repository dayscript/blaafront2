<!--Menu seccion-->

<nav class="subMenu medium-12 {{ get_class_for_menu(Request::path()) }}" >
    <div class="subContent medium-12">

        <div class="medium-8 columns"><h2><span><a style="color:#fff" href="/musica/opus">{{ isset($menu)? $menu['submenu']['title']:'' }}</a></span>
                <em>{{ isset($menu)? $menu['submenu']['subtitle']:'' }}</em></h2></div>
        <!--<div class="lFiltro large-4 columns">
                <select class="customSelect">
                <option>BOGOTÁ</option>
                <option>CALI</option>
                <option>MEDELLÍN</option>
                <option>ARMENIA</option>
                <option>PEREIRA</option>
                <option>MANIZALES</option>
                <option>IBAGUÉ</option>
            </select>
        </div>-->
    </div>
    <ul class="menu dropdown" data-dropdown-menu>
        @if(isset($menu['submenu']['options']))
            @foreach($menu['submenu']['options'] as $url => $suboption)
                <li>
                    <a href="{{ $suboption['url'] }}" class="{{ url_is_active( Request::path(),$suboption['url'] )}}">
                        <span>{{ $suboption['label'] }}</span></a>
                        @if( isset($suboption['suboptions']))
                        <ul class="menu trasparent">
                            @foreach($suboption['suboptions'] as $link => $suboptions)
                            <li><a href="{{$suboptions['url']}}">{{$suboptions['label']}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                </li>
            @endforeach
        @endif
    </ul>
</nav>
<!--Fin menu seccion-->
