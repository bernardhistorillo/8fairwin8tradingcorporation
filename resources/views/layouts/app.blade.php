<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="{{ config('app.name') }} - @yield('title')" />
    <meta name="description" content="The Smart Market Exchange">
    <meta name="author" content="Michael Alcala">
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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/pace-progress/css/pace.min.css') }}" rel="stylesheet">

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name') }} - @yield('title')</title>
</head>
<body>
@yield('content')

@include('includes.footer')
@include('includes.modals')

<input type="hidden" name="route_name" value="{{ Route::currentRouteName() }}" />
<input type="hidden" name="app_url" value="{{ config('app.url') }}" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
