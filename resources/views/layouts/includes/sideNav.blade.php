<ul class="navbar-nav sidebar sidebar-dark accordion bg-color-5" id="accordionSidebar" style="border-right:1px solid rgba(16,77,34,0.2)">
    @if(substr(Route::currentRouteName(), 0, 6) != 'admin.')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.index') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo/fairwin-logo.png') }}" alt="8Fairwin8 Trading Corporation" width="40" />
        </div>
        <div class="sidebar-brand-text mx-3">
            <img src="{{ asset('img/logo/fairwin-horizontal-text-white.png') }}" alt="8Fairwin8 Trading Corporation" height="25" />
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ (Route::currentRouteName() == 'dashboard.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fa-solid fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'income.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('income.index') }}">
            <i class="fa-solid fa-fw fa-money-bill-alt"></i>
            <span>Earnings</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'orders.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="fa-solid fa-fw fa-shopping-bag"></i>
            <span>Orders</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'network.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('network.index') }}">
            <i class="fa-solid fa-fw fa-users"></i>
            <span>Network</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'products.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fa-solid fa-fw fa-gift"></i>
            <span>Products</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'transfers.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('transfers.index') }}">
            <i class="fa-solid fa-fw fa-money-bill-transfer"></i>
            <span>Transfers</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'conversions.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('conversions.index') }}">
            <i class="fa-solid fa-fw fa-sync"></i>
            <span>Conversions</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'withdrawals.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('withdrawals.index') }}">
            <i class="fa-solid fa-fw fa-credit-card"></i>
            <span>Withdrawals</span>
        </a>
    </li>

        @if(Auth::user()->stockist > 0)
    <li class="nav-item {{ (Route::currentRouteName() == 'terminal.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('terminal.index') }}">
            <i class="fa-solid fa-fw fa-store"></i>
            <span>Terminal</span>
        </a>
    </li>
        @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline mb-4">
        <button class="rounded-circle btn-custom-3 border-0" id="sidebarToggle"></button>
    </div>

        @if(!Auth::user()->email_verified_at)
    <div class="sidebar-card d-none d-lg-flex bg-color-1">
        <i class="fa-solid fa-envelope sidebar-card-illustration mb-0 font-size-250 text-white"></i>
        <p class="text-center text-white mb-3">Verify your email now!</p>
        <button class="btn btn-custom-2 btn-sm font-size-80 verify-email-show-modal" value="{{ route('profile.sendEmailOTP') }}">VERIFY</button>
    </div>
      @endif

    @else
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard.index') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo/fairwin-logo.png') }}" alt="8Fairwin8 Trading Corporation" width="40" />
        </div>
        <div class="sidebar-brand-text mx-3 mt-2">
            <img src="{{ asset('img/logo/fairwin-horizontal-text-white.png') }}" class="mb-1" alt="8Fairwin8 Trading Corporation" height="25" />
            <p class="text-color-2 font-size-80 mb-0">ADMIN</p>
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ (Route::currentRouteName() == 'admin.dashboard.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fa-solid fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'admin.users.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fa-solid fa-fw fa-user"></i>
            <span>Users</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'admin.genealogy.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.genealogy.index') }}">
            <i class="fa-solid fa-fw fa-users"></i>
            <span>Genealogy</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'admin.winnersGem.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.winnersGem.index') }}">
            <i class="fa-solid fa-fw fa-gem"></i>
            <span>Winners Gem</span>
        </a>
    </li>

    <li class="nav-item {{ (Route::currentRouteName() == 'admin.orders.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="fa-solid fa-fw fa-shopping-bag"></i>
            <span>Orders</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline mb-4">
        <button class="rounded-circle btn-custom-3 border-0" id="sidebarToggle"></button>
    </div>
    @endif
</ul>
