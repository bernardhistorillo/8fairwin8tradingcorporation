@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="d-flex align-items-center" style="min-height: calc(100vh - 101px)">
        <div>
            <div class="card mt-5">
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
                                <input class="form-control" id="register-sponsors-code" type="text" data-action="{{ route('register.checkSponsor') }}" placeholder="Registration Code">
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
                        <button class="btn btn-success" id="register-show-confirmation" type="button" data-action="{{ route('register.submit') }}" style="width:160px">Create Account</button>
                    </div>
                </div>
            </div>

            <div class="text-center"> <p> Already have an account? <a href="{{ route('login.index') }}">Log In</a></p>
        </div>
    </div>
</div>
@endsection
