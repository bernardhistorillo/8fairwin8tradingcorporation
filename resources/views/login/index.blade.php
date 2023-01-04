@extends('layouts.app')

@section('title', 'Log In')

@section('content')
<nav class="app-header navbar" style="position:relative">
    <a class="navbar-brand" href="{{ route('home.index') }}">
        <img class="navbar-brand-full" src="img1/about-img.jpg?v=1" style="width:80px" alt="">
    </a>
</nav>

<ol class="breadcrumb mb-0">
    <li class="breadcrumb-item breadcrumb-item-custom" style="padding-right:7px">
        <a href="{{ route('home.index') }}" style="color:#606060"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a>
    </li>
    <li class="breadcrumb-item breadcrumb-item-custom" style="padding-right:7px">
        <a href="{{ route('login.index') }}" style="color:#0E4D22; font-weight:700"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Log In</a>
    </li>
    <li class="breadcrumb-item breadcrumb-item-custom">
        <a href="{{ route('register.index') }}" style="color:#606060"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Register</a>
    </li>
</ol>

<div class="container">
    <div class="row align-items-center justify-content-center" style="min-height: calc(100vh - 101px)">
        <div class="col-md-8 col-lg-6 my-5">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <h4 class="text-center mb-3">Log In</h4>

                    <form id="login-form" action="{{ route('login.submit') }}">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                            </div>
                            <input class="form-control" id="login-username" type="text" placeholder="Username">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                            </div>
                            <input class="form-control" id="login-password" type="password" placeholder="Password">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success" type="submit" style="width:120px">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center"> <p> Not a member yet? <a href="https://fairwintradingcorp.com/portal/register.php">Sign Up</a></p>
        </div>
    </div>
</div>
@endsection
