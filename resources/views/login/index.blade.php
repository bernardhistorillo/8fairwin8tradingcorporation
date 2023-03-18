@extends('layouts.app')

@section('title', 'Log In')

@section('content')
@include('home.includes.nav')

<div class="background-image-cover" style="background-image:url('{{ asset('img/background/register.webp') }}')">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="row justify-content-center py-5">
                <div class="col-sm-10 col-md-8 pt-5 pb-4">
                    <p class="text-color-1 code-pro-bold-lc line-height-110 font-size-170 font-size-sm-230 font-size-md-220 font-size-lg-230 font-size-xl-230 font-size-xxl-250 text-center mt-4 mb-4 pb-2">Welcome Back to Your Path to Well&#8209;Being</p>

                    <div class="card border-0 mb-4">
                        <div class="card-body p-4 p-sm-5">
                            <p class="text-center code-pro-lc font-size-130">Log In</p>
                            <form id="login-form" action="{{ route('login.submit') }}">
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="login-username" type="text" placeholder="Username">
                                    <div class="position-absolute" style="right:20px; top:9px">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="login-password" type="password" placeholder="Password">
                                    <div class="position-absolute" style="right:20px; top:9px">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>

                                <div class="text-center mt-2">
                                    <button type="submit" class="btn btn-custom-2 px-5 py-3">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-white font-size-110">Not a member yet? <a href="{{ route('register.index') }}" class="link-color-2 code-pro-bold-lc">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('home.includes.footer')
@endsection
