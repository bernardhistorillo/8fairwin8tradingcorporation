<ul class="navbar-nav sidebar sidebar-dark accordion bg-color-5" id="accordionSidebar" style="border-right:1px solid rgba(16,77,34,0.2)">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
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

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle btn-custom-3 border-0" id="sidebarToggle"></button>
    </div>
</ul>

{{--<div class="sidebar">--}}
{{--	<nav class="sidebar-nav">--}}
{{--		<div class="profile-pic-lg" style="text-align:center; padding:15px 0px">--}}
{{--			<a href="{{ route('account.index') }}" class="text-white">--}}
{{--				<div style="width:100px; display:inline-block">--}}
{{--					<div class="text-center change-profile-picture-container" style="background-image:url('{{ Auth::user()->photo() }}'); background-size:cover; background-repeat:no-repeat; background-position:center; width:100%; border-radius:50%; border:3px solid #ffffff; position:relative; padding-top:100%; cursor:pointer">--}}
{{--						<i class="fas fa-spinner fa-2x fa-spin d-none profile-picture-loading" style="color:#ffffff; position:absolute; top:calc(50% - 14px); left:calc(50% - 14px); "></i>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</a>--}}
{{--		</div>--}}

{{--		<div class="profile-pic-sm d-none" style="text-align:center; padding:15px 0px">--}}
{{--			<a href="{{ route('account.index') }}" class="text-white">--}}
{{--				<div style="width:36px; display:inline-block">--}}
{{--					<div class="text-center change-profile-picture-container" style="background-image:url('{{ Auth::user()->photo() }}'); background-size:cover; background-repeat:no-repeat; background-position:center; width:100%; border-radius:50%; border:0.1em solid #ffffff; position:relative; padding-top:100%; cursor:pointer">--}}
{{--						<i class="fas fa-spinner fa-2x fa-spin d-none profile-picture-loading" style="color:#ffffff; position:absolute; top:calc(50% - 14px); left:calc(50% - 14px); "></i>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</a>--}}
{{--		</div>--}}
{{--  	</nav>--}}
{{--  	<button class="sidebar-minimizer brand-minimizer" id="minimize-side-nav" type="button"></button>--}}
{{--</div>--}}
