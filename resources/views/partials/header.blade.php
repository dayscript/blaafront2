<!--Encabezado-->
<header class="pageHeader row">
    <div class="headerTop large-12">
        <h1 class="large-7 columns"><a href="http://www.banrepcultural.org/">Banco de la República Actividad Cultural</a></h1>
        <div class="cRight large-5 columns">
            <ul class="socialNetworks large-4 columns">
                <li><a href="https://www.facebook.com/" target="_blank" class="facebook">facebook</a></li>
                <li><a href="https://twitter.com/?lang=es" target="_blank" class="twitter">twitter</a></li>
                <li><a href="https://www.youtube.com/user/BancoRepublica" target="_blank" class="youtube">youtube</a></li>
            </ul>
            <form class="large-8 columns">
                <input class="large-12 columns " type="text" placeholder="| Buscar">
                <input type="button" value="Enviar" class="btnSearch">
            </form>
        </div>
        <nav class="mainMenu large-12">
            <ul class="menu">
                @foreach($menu as $url=>$item)
                    <li><a href="{{ $item['url'] }}" class="{{ $item['style'] }} {{ Request::is($url)?'active':'' }}" ><span>{!! $item['label']  !!}</span></a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</header><!--Fin Encabezado-->
