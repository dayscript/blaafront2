<!DOCTYPE HTML>
<html>
<head>
    @section('meta')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:site_name" content="Banco de la República"/>
    @show
    <title>@section('title') :: Banco de la República @show</title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon">
    @yield('styles')
</head>
<body>
<div id="mainWrapper">
    @include('partials.header')
    <div class="mainContent row medium-collapse ">
        @include('partials.submenu')
        @yield('content')

        <div class="columns medium-12">
            @include('partials.footer')
        </div>
    </div>
</div>
@yield('scripts')
<script src="{{ asset('js/prefixfree.min.js')  }}"></script>
<script src="{{ asset('js/jquery.min.js')  }}"></script>
<script src="{{ asset('js/jquery-ui.min.js')  }}"></script>
<script src="{{ asset('js/jquery.colorbox-min.js')  }}"></script>
<script src="{{ asset('js/jquery.cycle2.min.js')  }}"></script>
<script src="{{ asset('js/interface.js')  }}"></script>
<script src="{{ elixir('js/app.js')  }}"></script>
</body>
</html>