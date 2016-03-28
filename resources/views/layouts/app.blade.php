<!DOCTYPE HTML>
<html ng-app="Blaa">
<head>
    @section('meta')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:site_name" content="Banco de la República"/>
        <script src="{{ asset('js/angular.min.js')  }}"></script>
    @show
    <title>@section('title') :: Banco de la República @show</title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/angular-material.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/angular-material.layouts.min.css') }}" rel="stylesheet">

    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon">
    @yield('styles')

</head>
<base href="/" />
<body>
    @include('partials.header')
<div id="mainWrapper">
    <div class="mainContent row medium-collapse ">
        @include('partials.submenu')
         @if (session('status'))
            <div data-alert class="callout large success custom" data-closable="slide-out-right">
                {{ session('status') }}
                <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @yield('content')
    </div>
</div>
<div class="columns medium-12">
    @include('partials.footer')
</div>
@yield('scripts')
<script src="{{ asset('js/jquery.min.js')  }}"></script>
<script src="{{ asset('js/jquery-ui.min.js')  }}"></script>
<script src="{{ asset('js/jquery.colorbox-min.js')  }}"></script>
<script src="{{ asset('js/jquery.cycle2.min.js')  }}"></script>
<script src="{{ asset('js/foundation.core.js')  }}"></script>
<script src="{{ asset('js/foundation.accordion.js')  }}"></script>
<script src="{{ asset('js/foundation.util.keyboard.js')  }}"></script>
<script src="{{ asset('js/foundation.util.mediaQuery.js')  }}"></script>
<script src="{{ asset('js/foundation.util.motion.js')  }}"></script>
<script src="{{ asset('js/foundation.util.nest.js')  }}"></script>
<script src="{{ asset('js/foundation.util.touch.js')  }}"></script>
<script src="{{ asset('js/foundation.accordionMenu.js')  }}"></script>
<script src="{{ asset('js/motion-ui.min.js')  }}"></script>

<script src="{{ asset('js/angular-material.min.js')  }}"></script>
<script src="{{ asset('js/angular-aria.min.js')  }}"></script>
<script src="{{ asset('js/angular-animate.min.js')  }}"></script>
<script src="{{ asset('js/angular-messages.min.js')  }}"></script>
<script src="{{ asset('js/angular-route.min.js')  }}"></script>
<script src="{{ asset('js/prefixfree.min.js')  }}"></script>
<script src="{{ asset('js/interface.js')  }}"></script>




<script src="{{ elixir('js/app.js')  }}"></script>
</body>
</html>
