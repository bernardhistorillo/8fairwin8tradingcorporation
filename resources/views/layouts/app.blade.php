<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="{{ config('app.name') }} - @yield('title')" />
    <meta name="description" content="The Smart Market Exchange">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:url" content="{{ URL::current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name') }} - @yield('title')" />
    <meta property="og:description" content="The Smart Market Exchange" />
    <meta property="og:image" content="{{ asset('img/bg/og1.png') }}" />

    <link rel="icon" href="{{ asset('img/logo/100x100.png') }}">

    <link rel="icon" type="image/ico" href="img/logo-image.png" sizes="any" />
    <link href="{{ asset('lib/coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/treantjs/css/Treant.css') }}" rel="stylesheet"/>
    <link href="{{ asset('lib/datatables/datatables.min.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/style.css') }}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ asset('lib/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.3.0/css/all.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,700;0,800;0,900;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">

    <title>{{ config('app.name') }} | @yield('title')</title>
</head>
<body class="{{ Auth::check() ? 'app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show' : ''}}">
    @if(Auth::check())
        @include('layouts.includes.navbar')
    @endif

    @if(Auth::check())
    <div class="app-body">
        @include('layouts.includes.sideNav')
        @yield('content')
    </div>
    @else
        @yield('content')
    @endif

    @if(Auth::check())
        @include('layouts.includes.footer')
    @endif

    @include('layouts.includes.modals')

    <input type="hidden" name="winners_gem_value" value="{{ winnersGemValue() }}" />
    <input type="hidden" name="route_name" value="{{ Route::currentRouteName() }}" />
    <input type="hidden" name="app_url" value="{{ config('app.url') }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
{{--    <script src="{{ asset('lib/jquery/jquery-3.3.1.min.js') }}"></script>--}}
{{--    <script src="{{ asset('lib/popper/js/popper.min.js') }}"></script>--}}
{{--    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>--}}
    <script src="{{ asset('lib/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('lib/coreui/js/coreui.min.js') }}"></script>
    <script src="{{ asset('lib/coreui/js/custom-tooltips.min.js') }}"></script>
    <script src="{{ asset('lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('lib/treantjs/js/raphael.js') }}"></script>
    <script src="{{ asset('lib/treantjs/js/Treant.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset(mix('/js/app.js')) }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQSFHeqlKHBbfMQSN27kDpm2u7YSM5KZk"></script>

</body>
</html>
