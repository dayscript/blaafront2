<!--Encabezado-->
<header class="pageHeader row">
    <div class="headerTop medium-12">
        <h1 class="medium-7 columns"><a href="http://www.banrepcultural.org/">Banco de la República Actividad Cultural</a></h1>
        <div class="cRight medium-5 columns">
            <ul class="socialNetworks medium-4 columns">
                <li><a href="https://www.facebook.com/" target="_blank" class="facebook">facebook</a></li>
                <li><a href="https://twitter.com/?lang=es" target="_blank" class="twitter">twitter</a></li>
                <li><a href="https://www.youtube.com/user/BancoRepublica" target="_blank" class="youtube">youtube</a></li>
            </ul>
            <form class="medium-8 columns">
                <input class="medium-12 columns " type="text" placeholder="| Buscar">
                <input type="button" value="Enviar" class="btnSearch">
            </form>
        </div>
        <nav class="mainMenu medium-12">
            <ul class="menu">
                @foreach($menu['menu'] as  $url => $item)
                    <li><a href="{{ $item['url'] }}" class="{{$item['style']}} {{ url_is_active( Request::path(),$item['url'] ) }}" ><span>{!! $item['label']  !!}</span></a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</header><!--Fin Encabezado-->
