@extends('layouts.app')

@section('title', 'Register')

@section('content')
@include('home.includes.nav')

<div class="background-image-cover" style="background-image:url('{{ asset('img/background/register.webp') }}')">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 col-xl-9 col-xxl-8 pt-5 pb-4">
                    <p class="text-white code-pro-bold-lc line-height-110 font-size-200 font-size-sm-230 font-size-md-220 font-size-lg-230 font-size-xl-230 font-size-xxl-250 text-center mt-4 mb-4 pb-2">Join our Wellness Community</p>

                    <div class="card border-0 mb-4">
                        <div class="card-body p-4 p-sm-5">
                            <p class="text-center code-pro-lc font-size-130 mb-4">Create your account</p>
                            <form id="registration-form" action="{{ route('register.submit') }}">
                                <div class="row">
                                    <div class="col-md-6 px-2">
                                        <small>First Name</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="firstname" type="text" placeholder="First Name" required />
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-2">
                                        <small>Last Name</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="lastname" type="text" placeholder="Last Name">
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-2">
                                        <small>Email Address</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="email" type="email" placeholder="Email Address">
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-2">
                                        <small>Contact Number</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="contact_number" type="text" placeholder="Contact Number">
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 px-2">
                                        <small>Address</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="address" type="text" placeholder="Address">
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-2">
                                        <small>Username</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="username" type="text" placeholder="Username">
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-2">
                                        <small>Registration Code</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="sponsors_code" type="text" data-action="{{ route('register.checkSponsor') }}" placeholder="Registration Code" value="{{ session()->exists('referralCode') ? session()->get('referralCode') : 'dd' }}" />
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-user-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-2">
                                        <small>Password</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="password" type="password" placeholder="Password">
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-2">
                                        <small>Confirm Password</small>
                                        <div class="position-relative mb-2">
                                            <input class="form-control form-control-1 ps-3 pe-5 py-2" name="confirm_password" type="password" placeholder="Confirm password" >
                                            <div class="position-absolute" style="right:20px; top:9px">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-custom-2 px-5 py-3">Create Account</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-white font-size-110">Already have an account? <a href="{{ route('login.index') }}" class="link-color-2 code-pro-bold-lc">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('home.includes.footer')
@endsection
