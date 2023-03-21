<nav class="navbar navbar-dark fixed-top navbar-expand-lg">
    <div class="container position-relative">
        <a class="navbar-brand" href="{{ route('home.index') }}">
            <img src="{{ asset('img/logo/fairwin-horizontal-white.png') }}" style="opacity:0" alt="8Fairwin8 Trading Corporation">
            <img src="{{ asset('img/logo/fairwin-horizontal-white.png') }}" class="fairwin-colored position-absolute" style="top:5; left:12px" alt="8Fairwin8 Trading Corporation">
            <img src="{{ asset('img/logo/fairwin-horizontal.png') }}" class="fairwin-white position-absolute" style="top:5; left:12px" alt="8Fairwin8 Trading Corporation">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto font-weight-300 font-size-100 justify-content-center">
                @if(Auth::check())
                <li class="nav-item ms-md-3 ms-xl-4">
                    <a class="btn aileron-bold font-weight-500 px-4 py-2 mb-4 mb-lg-0 btn-custom-1" href="{{ route('dashboard.index') }}">GO TO DASHBOARD</a>
                </li>
                @else
                <li class="nav-item mb-2 mb-lg-0">
                    <a class="nav-link aileron-bold px-md-3 px-xl-4" href="https://8fairwin8tradingcorp.com/access/login.php">LOG IN</a>
                </li>
                <li class="nav-item ms-md-3 ms-xl-4">
                    <a class="btn aileron-bold font-weight-500 px-4 py-2 mb-4 mb-lg-0 btn-custom-1" href="https://8fairwin8tradingcorp.com/access/register.php">REGISTER NOW</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
