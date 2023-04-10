@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="bg-color-5">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-sm-10 col-lg-7 col-md-8 col-xl-6 col-xxl-5 pt-5 pb-4">
                <div class="card border-0 mb-4">
                    <div class="card-body p-4 p-sm-5">
                        <p class="text-center code-pro-lc font-size-130 mb-4">Reset Password</p>
                        <form id="reset-password-form" action="{{ route('profile.resetPassword', $uuid) }}">
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-1 ps-3 pe-5 py-2" name="new_password" type="password" placeholder="New Password">
                                <div class="position-absolute" style="right:20px; top:9px">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>

                            <div class="position-relative mb-4">
                                <input class="form-control form-control-1 ps-3 pe-5 py-2" name="confirm_password" type="password" placeholder="Confirm Password">
                                <div class="position-absolute" style="right:20px; top:9px">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>

                            <div class="text-center pt-1">
                                <button type="submit" class="btn btn-custom-2 px-5 py-2">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
