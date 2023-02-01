@extends('layouts.app')

@section('title', 'Log In')

@section('content')
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
            <div class="text-center"> <p> Not a member yet? <a href="{{ route('register.index') }}">Sign Up</a></p>
        </div>
    </div>
</div>
@endsection
