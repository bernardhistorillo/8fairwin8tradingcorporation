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
    <link href="{{ asset('lib/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/pace-progress/css/pace.min.css') }}" rel="stylesheet">

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name') }} | @yield('title')</title>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('layouts.includes.navbar')

    <div class="app-body">
        @include('layouts.includes.sideNav')
        @yield('content')
    </div>

    @include('layouts.includes.footer')
    @include('layouts.includes.modals')

    <input type="hidden" name="winners_gem_value" value="{{ winnersGemValue() }}" />
    <input type="hidden" name="route_name" value="{{ Route::currentRouteName() }}" />
    <input type="hidden" name="app_url" value="{{ config('app.url') }}" />

    <script src="{{ asset('lib/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('lib/popper/js/popper.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lib/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('lib/coreui/js/coreui.min.js') }}"></script>
    <script src="{{ asset('lib/coreui/js/custom-tooltips.min.js') }}"></script>
    <script src="{{ asset('lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
