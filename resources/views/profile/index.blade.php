@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Profile</h6>

        <div class="text-center">
            <button class="btn btn-custom-2 btn-sm font-size-80 px-3" id="edit-personal-info-show-fields">Edit Account Information</button>
            <button class="btn btn-custom-2 btn-sm font-size-80 px-3" id="reset-password-show-modal" value="{{ Auth::user()->email_verified_at }}">Reset Password</button>
            <button class="btn btn-custom-2 btn-sm font-size-80 px-3" id="change-pin-code-show-fields">Change Pin Code</button>
        </div>
    </div>

    <div class="animated fadeIn pt-2 pb-5">
        <input type="hidden" id="edit-personal-info-route" value="{{ route('profile.editPersonalInfo') }}" />

        <h6>Personal Information</h6>
        <div class="row align-items-stretch px-2">
            <div class="col-md-6 order-1 order-md-0 px-2">
                <small>First Name</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-firstname" type="text" placeholder="First Name" value="{{ Auth::user()->firstname }}" prev-value="{{ Auth::user()->firstname }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <small>Last Name</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-lastname" type="text" placeholder="Last Name" value="{{ Auth::user()->lastname }}" prev-value="{{ Auth::user()->lastname }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <small>Username</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-username" type="text" placeholder="Username" value="{{ Auth::user()->username }}" prev-value="{{ Auth::user()->username }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                @if(Auth::user()->email_verified_at)
                <small>Email Address <span class="text-color-2 ps-1">(Verified)</span></small>
                @else
                <small>Email Address <span class="text-color-1 ps-1">(Unverified)</span> <button class="btn btn-custom-1 btn-sm font-size-90 py-0 mb-1 ms-1 verify-email-show-modal" value="{{ route('profile.sendEmailOTP') }}">Verify Now</button></small>
                @endif
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-email-address" type="text" placeholder="Email Address" value="{{ Auth::user()->email }}" prev-value="{{ Auth::user()->email }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <small>Contact Number</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-contact-number" type="text" placeholder="Contact Number" value="{{ Auth::user()->contact_number }}" prev-value="{{ Auth::user()->contact_number }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-phone"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6 order-0 order-md-1 px-2">
                <div class="d-flex justify-content-center align-items-center h-100 me-xl-4">
                    <div class="col-11 col-sm-6 col-md-11 col-lg-10 col-xl-9 col-xxl-8 mt-3 mt-md-0 mb-3 mb-md-0" id="change-profile-picture">
                        <div class="text-center change-profile-picture-container" style="background-image:url('{{ Auth::user()->photo() }}'); background-size:cover; background-repeat:no-repeat; background-position:center; width:100%; border-radius:50%; border:2px solid #aaaaaa; position:relative; padding-top:100%; cursor:pointer">
                            <i class="fas fa-spinner fa-2x fa-spin d-none profile-picture-loading" style="color:#ffffff; position:absolute; top:calc(50% - 14px); left:calc(50% - 14px); "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h6 class="mt-4 mb-3">Payout Information</h6>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="payout-method" id="payout-method-bdo" value="BDO" {{ ($payoutInformation["method"] == "BDO") ? 'checked' : '0' }} style="margin-top:3px" disabled>
            <label class="form-check-label" for="payout-method-bdo">BDO</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="payout-method" id="payout-method-palawan-express" value="Palawan Express" {{ ($payoutInformation["method"] == "Palawan Express") ? 'checked' : '0' }} style="margin-top:3px" disabled>
            <label class="form-check-label" for="payout-method-palawan-express">Palawan Express</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="payout-method" id="payout-method-gcash" value="GCash" {{ ($payoutInformation["method"] == "GCash") ? 'checked' : '0' }} style="margin-top:3px" disabled>
            <label class="form-check-label" for="payout-method-gcash">GCash</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="payout-method" id="payout-method-coinsph" value="Coins.ph" {{ ($payoutInformation["method"] == "Coins.ph") ? 'checked' : '0' }} style="margin-top:3px" disabled>
            <label class="form-check-label" for="payout-method-coinsph">Coins.ph</label>
        </div>

        <div class="row px-2 mt-2">
            <div class="col-md-6 px-2 payout-field payout-method-bdo" style="{{ ($payoutInformation["method"] != "BDO") ? 'display:none' : '' }}">
                <small>Account Number</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-payout-account-number" type="text" placeholder="Account Number" value="{{ $payoutInformation["account_number"] }}" prev-value="{{ $payoutInformation["account_number"] }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-money-check-dollar"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-2 payout-field payout-method-bdo" style="{{ ($payoutInformation["method"] != "BDO") ? 'display:none' : '' }}">
                <small>Account Name</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-payout-account-name" type="text" placeholder="Account Name" value="{{ $payoutInformation["account_name"] }}" prev-value="{{ $payoutInformation["account_name"] }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-money-check-dollar"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-2 payout-field payout-method-palawan-express" style="{{ ($payoutInformation["method"] != "Palawan Express") ? 'display:none' : '' }}">
                <small>Name</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-payout-name" type="text" placeholder="Name" value="{{ $payoutInformation["name"] }}" prev-value="{{ $payoutInformation["name"] }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-2 payout-field payout-method-palawan-express payout-method-gcash" style="{{ ($payoutInformation["method"] != "Palawan Express" && $payoutInformation["method"] != "GCash") ? 'display:none' : '' }}">
                <small>Mobile Number</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-payout-mobile-number" type="text" placeholder="Mobile Number" value="{{ $payoutInformation["mobile_number"] }}" prev-value="{{ $payoutInformation["mobile_number"] }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-2 payout-field payout-method-coinsph" style="{{ ($payoutInformation["method"] != "Coins.ph") ? 'display:none' : '' }}">
                <small>Wallet Address</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-payout-wallet-address" type="text" placeholder="Wallet Address" value="{{ $payoutInformation["wallet_address"] }}" prev-value="{{ $payoutInformation["wallet_address"] }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row px-2" id="password-fields" style="display:none">
            <div class="col-md-4 px-2">
                <div class="form-group">
                    <small>Current Password</small>
                    <input type="password" class="form-control" id="edit-current-password" />
                </div>
            </div>
            <div class="col-md-4 px-2">
                <div class="form-group">
                    <small>New Password</small>
                    <input type="password" class="form-control" id="edit-new-password" />
                </div>
            </div>
            <div class="col-md-4 px-2">
                <div class="form-group">
                    <small>Confirm Password</small>
                    <input type="password" class="form-control" id="edit-confirm-password" />
                </div>
            </div>
        </div>

        <div class="row px-2" id="pin-code-fields" style="display:none">
            <div class="col-md-4 px-2">
                <div class="form-group">
                    <small>Current Pin Code</small>
                    <input type="password" class="form-control" id="edit-current-pin-code" />
                </div>
            </div>
            <div class="col-md-4 px-2">
                <div class="form-group">
                    <small>New Pin Code</small>
                    <input type="password" class="form-control" id="edit-new-pin-code" />
                </div>
            </div>
            <div class="col-md-4 px-2">
                <div class="form-group">
                    <small>Confirm Pin Code</small>
                    <input type="password" class="form-control" id="edit-confirm-pin-code" />
                </div>
            </div>
        </div>

        <div class="text-center mt-5 mb-4">
            <button class="btn btn-custom-2" id="cancel" style="background-color:#0e4d22; color:#ffffff; width:205px; display:none">Cancel</button>
            <button class="btn btn-custom-2" id="edit-personal-info" style="background-color:#0e4d22; color:#ffffff; width:205px; display:none">Save Changes</button>
        </div>
    </div>
</main>

<div class="modal fade" id="modal-verify-email" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Email Verification</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>

            <form id="email-verification-form" action="{{ route('profile.verifyEmail') }}">
                <div class="modal-body">
                    <p class="text-center" id="sending-pin">We are sending One-Time Pin to <span class="fw-bold">{{ Auth::user()->email }}</span>.</p>
                    <p class="text-center" id="pin-sent">We just sent a One-Time Pin to <span class="fw-bold">{{ Auth::user()->email }}</span>. Copy and paste the pin below.</p>

                    <div class="position-relative mb-2">
                        <input class="form-control form-control-1 text-center px-5 py-2 numeric-only" name="otp" type="text" placeholder="Enter One-Time Pin" style="letter-spacing: 5px">
                        <div class="position-absolute" style="right:20px; top:9px">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <p class="text-center text-color-4 mb-1 d-none font-size-90" id="verify-email-error"></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom-2 px-4 proceed" id="verify-email">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-email-not-verified" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-body text-center py-3">
                <div class="pt-2">
                    <i class="fa-regular fa-exclamation-circle font-size-450 text-color-4 mb-3"></i>
                </div>
                <p class="mb-0">You're email address must be verified before you can reset your password.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-4 font-size-90 px-4 verify-email-show-modal" data-bs-dismiss="modal" value="{{ route('profile.sendEmailOTP') }}">Verify Email Now</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Change Password</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-2 px-4 proceed" id="withdraw-confirm">Withdraw</button>
            </div>
        </div>
    </div>
</div>
@endsection
