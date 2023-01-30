<header class="app-header navbar" style="background-color:#deefbb">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon" style="color:#134c21"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home.index') }}" style="padding-left:10px">
        <img class="navbar-brand-full" src="{{ asset('img1/about-img.jpg') }}" style="width:80px" alt="">
        <!--    <img class="navbar-brand-minimized" src="img1/about-img.jpg" style="width:45px" alt="">-->
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show"  style="color:#134c21">
        <span class="navbar-toggler-icon" style="color:#134c21"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> <span class="d-none d-sm-inline" style="margin-left:5px; margin-right:20px">{{ Auth::user()->fullName() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Username: {{ Auth::user()->username }}</span></strong>
                </div>
                <a class="dropdown-item" href="javascript:void(0)" id="logout">
                    <i class="fa fa-lock"></i> Logout</a>
            </div>
        </li>
    </ul>
</header>
