<div class="sidebar">
	<nav class="sidebar-nav">
		<div class="profile-pic-lg" style="text-align:center; padding:15px 0px">
			<a href="{{ route('account.index') }}" class="text-white">
				<div style="width:100px; display:inline-block">
					<div class="text-center change-profile-picture-container" style="background-image:url('{{ Auth::user()->photo() }}'); background-size:cover; background-repeat:no-repeat; background-position:center; width:100%; border-radius:50%; border:3px solid #ffffff; position:relative; padding-top:100%; cursor:pointer">
						<i class="fas fa-spinner fa-2x fa-spin d-none profile-picture-loading" style="color:#ffffff; position:absolute; top:calc(50% - 14px); left:calc(50% - 14px); "></i>
					</div>
				</div>
			</a>
		</div>

		<div class="profile-pic-sm d-none" style="text-align:center; padding:15px 0px">
			<a href="{{ route('account.index') }}" class="text-white">
				<div style="width:36px; display:inline-block">
					<div class="text-center change-profile-picture-container" style="background-image:url('{{ Auth::user()->photo() }}'); background-size:cover; background-repeat:no-repeat; background-position:center; width:100%; border-radius:50%; border:0.1em solid #ffffff; position:relative; padding-top:100%; cursor:pointer">
						<i class="fas fa-spinner fa-2x fa-spin d-none profile-picture-loading" style="color:#ffffff; position:absolute; top:calc(50% - 14px); left:calc(50% - 14px); "></i>
					</div>
				</div>
			</a>
		</div>

 		<ul class="nav">
			<li class="nav-item">
			    <a class="nav-link {{ (Route::currentRouteName() == 'dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
				   <i class="nav-icon fas fa-tachometer-alt" {{ (Route::currentRouteName() != 'dashboard.index') ? 'style="color:#73818f"' : '' }}></i> Dashboard
			    </a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'income.index') ? 'active' : '' }}" href="{{ route('income.index') }}">
					<i class="nav-icon fas fa-money-bill-alt" {{ (Route::currentRouteName() != 'income.index') ? 'style="color:#73818f"' : '' }}></i> Earnings
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'orders.index') ? 'active' : '' }}" href="{{ route('orders.index') }}">
					<i class="nav-icon fas fa-shopping-bag" {{ (Route::currentRouteName() != 'orders.index') ? 'style="color:#73818f"' : '' }}></i> Orders
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'network.index') ? 'active' : '' }}" href="{{ route('network.index') }}">
					<i class="nav-icon fas fa-users" {{ (Route::currentRouteName() != 'network.index') ? 'style="color:#73818f"' : '' }}></i> Network
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">
					<i class="nav-icon fas fa-gift" {{ (Route::currentRouteName() != 'products.index') ? 'style="color:#73818f"' : '' }}></i> Products
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'account.index') ? 'active' : '' }}" href="{{ route('account.index') }}">
					<i class="nav-icon fas fa-user" {{ (Route::currentRouteName() != 'account.index') ? 'style="color:#73818f"' : '' }}></i> Account
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'transfers.index') ? 'active' : '' }}" href="{{ route('transfers.index') }}">
					<i class="nav-icon fas fa-share" {{ (Route::currentRouteName() != 'transfers.index') ? 'style="color:#73818f"' : '' }}></i> Transfers
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'conversions.index') ? 'active' : '' }}" href="{{ route('conversions.index') }}">
					<i class="nav-icon fas fa-sync" {{ (Route::currentRouteName() != 'conversions.index') ? 'style="color:#73818f"' : '' }}></i> Conversions
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'withdrawals.index') ? 'active' : '' }}" href="{{ route('withdrawals.index') }}">
					<i class="nav-icon fas fa-credit-card" {{ (Route::currentRouteName() != 'withdrawals.index') ? 'style="color:#73818f"' : '' }}></i> Withdrawals
				</a>
			</li>
			@if(Auth::user()->stockist > 0)
			<li class="nav-item">
				<a class="nav-link {{ (Route::currentRouteName() == 'terminal.index') ? 'active' : '' }}" href="{{ route('terminal.index') }}">
					<i class="nav-icon fas fa-store" {{ (Route::currentRouteName() != 'terminal.index') ? 'style="color:#73818f"' : '' }}></i> Terminal
				</a>
			</li>
			@endif
	 	</ul>
  	</nav>
  	<button class="sidebar-minimizer brand-minimizer" id="minimize-side-nav" type="button"></button>
</div>
