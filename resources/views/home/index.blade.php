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

<div class="container pb-5">
    <div class="card mt-4">
        <div class="card-body p-4">
            <h4 class="text-center mb-3">Registration Form</h4>

            <p class="text-muted">Create your account</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-firstname" type="text" placeholder="First Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-lastname" type="text" placeholder="Last Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-email-address" type="email" placeholder="Email Address">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-contact-number" type="text" placeholder="Contact Number">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-map-marker"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-address" type="text" placeholder="Address">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-username" type="text" placeholder="Username">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-users"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-sponsors-code" type="text" placeholder="Registration Code">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-password" type="password" placeholder="Password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-confirm-password" type="password" placeholder="Repeat password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-pin-code" type="password" placeholder="Winners Gem Pin Code">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input class="form-control" id="register-confirm-pin-code" type="password" placeholder="Repeat Winners Gem Pin Code">
                    </div>
                </div>
            </div>

            <p class="text-center">
                Offered By:
                <span id="register-sponsor-blank" class="text-warning" style="font-weight:bold; font-style:italic; display:inline-block">(Enter Registration Code)</span>
                <span id="register-sponsor-no-match" class="text-danger" style="font-weight:bold; font-style:italic; display:none">(Referral Code didn't match any account)</span>
                <span id="register-sponsor-has-match" class="text-success" style="font-weight:bold; display:none">Bernard Q. Historillo</span>
                <span id="register-sponsor-loading" style="font-weight:bold; font-style:italic; display:none">Loading...</span>
            </p>

            <div class="text-center mt-2">
                <button class="btn btn-success" id="register-show-confirmation" type="button" style="width:160px">Create Account</button>
            </div>
        </div>
    </div>
</div>
@endsection
