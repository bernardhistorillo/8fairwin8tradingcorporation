<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <meta name="title" content="{{ config('app.name') }} - @yield('title')" />--}}
    <meta name="description" content="The Smart Market Exchange">
{{--    <meta name="author" content="{{ config('app.name') }}">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    <meta property="og:url" content="{{ URL::current() }}" />--}}
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name') }} - @yield('title')" />
    <meta property="og:description" content="The Smart Market Exchange" />
    <meta property="og:image" content="{{ asset('img/bg/og1.png') }}" />

    <link rel="icon" href="{{ asset('img/logo/100x100.png') }}">

    <link rel="icon" type="image/ico" href="img/logo-image.png" sizes="any" />
    <link href="{{ asset('lib/treantjs/css/Treant.css') }}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="{{ asset('lib/sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.3.0/css/all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,700;0,800;0,900;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat"></div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "111609378177653");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v16.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>
<body>
    @if(Auth::check() && Route::currentRouteName() != 'home.index')
    <div id="wrapper">
        @include('layouts.includes.sideNav')

        <div id="content-wrapper" class="d-flex flex-column bg-white">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

{{--                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">--}}
{{--                        <div class="input-group">--}}
{{--                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <button class="btn btn-primary" type="button">--}}
{{--                                    <i class="fas fa-search fa-sm"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                 aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

{{--                        <li class="nav-item dropdown no-arrow mx-1">--}}
{{--                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="fas fa-bell fa-fw"></i>--}}
{{--                                <span class="badge badge-danger badge-counter" style="right:-2px">3</span>--}}
{{--                            </a>--}}

{{--                            <div class="dropdown-list dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="alertsDropdown">--}}
{{--                                <h6 class="dropdown-header">--}}
{{--                                    Alerts Center--}}
{{--                                </h6>--}}
{{--                                <a class="dropdown-item d-flex align-items-center" href="#">--}}
{{--                                    <div class="mr-3">--}}
{{--                                        <div class="icon-circle bg-primary">--}}
{{--                                            <i class="fas fa-file-alt text-white"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <div class="small text-gray-500">December 12, 2019</div>--}}
{{--                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item d-flex align-items-center" href="#">--}}
{{--                                    <div class="mr-3">--}}
{{--                                        <div class="icon-circle bg-success">--}}
{{--                                            <i class="fas fa-donate text-white"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <div class="small text-gray-500">December 7, 2019</div>--}}
{{--                                        $290.29 has been deposited into your account!--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item d-flex align-items-center" href="#">--}}
{{--                                    <div class="mr-3">--}}
{{--                                        <div class="icon-circle bg-warning">--}}
{{--                                            <i class="fas fa-exclamation-triangle text-white"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <div class="small text-gray-500">December 2, 2019</div>--}}
{{--                                        Spending Alert: We've noticed unusually high spending for your account.--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-gem text-color-2 font-size-130 fa-fw gem-change-color"></i>
                                <span class="d-none d-md-inline text-gray-600 small ps-2">Winners Gem Value: &nbsp;&#8369;&nbsp;{{ number_format(winnersGemValue(), 2) }}</span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-bs-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="me-3 d-none d-md-inline text-gray-600 small">{{ Auth::user()->fullName() }}</span>
                                <div class="img-profile rounded-circle background-image-cover" style="background-image:url('{{ Auth::user()->photo() }}'); border:1px solid rgba(16,77,34,0.2); height:40px; width:40px"></div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('account.index') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('auth.logout') }}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <footer class="sticky-footer bg-white" style="border-top:1px solid rgba(16,77,34,0.2)">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © 8Fairwin8 Trading Corporation 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

{{--    @if(Auth::check())--}}
{{--        @include('layouts.includes.navbar')--}}
{{--    @endif--}}

    @else
        @yield('content')
    @endif

    @include('layouts.includes.modals')

    <input type="hidden" name="winners_gem_value" value="{{ winnersGemValue() }}" />
    <input type="hidden" name="route_name" value="{{ Route::currentRouteName() }}" />
    <input type="hidden" name="app_url" value="{{ config('app.url') }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('lib/sb-admin/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="{{ asset('lib/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('lib/treantjs/js/raphael.js') }}"></script>
    <script src="{{ asset('lib/treantjs/js/Treant.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset(mix('/js/app.js')) }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQSFHeqlKHBbfMQSN27kDpm2u7YSM5KZk"></script>

</body>
</html>
