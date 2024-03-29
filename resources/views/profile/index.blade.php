@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Profile</h6>

        <div class="text-center">
            <button class="btn btn-custom-2 btn-sm font-size-80 px-3" id="edit-personal-info-show-fields">Edit Account Information</button>
            <button class="btn btn-custom-2 btn-sm font-size-80 px-3" id="reset-password-show-modal" value="{{ Auth::user()->email_verified_at }}">Reset Password</button>
        </div>
    </div>

    <div class="animated fadeIn pt-2 pb-5">
        <input type="hidden" id="edit-personal-info-route" value="{{ route('profile.editPersonalInfo') }}" />

        <h6>Personal Information</h6>
        <div class="row align-items-stretch px-2">
            <div class="col-md-6 order-1 order-md-0 px-2">
                <small>First Name</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-firstname" name="firstname" type="text" placeholder="First Name" value="{{ Auth::user()->firstname }}" prev-value="{{ Auth::user()->firstname }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <small>Last Name</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-lastname" name="lasstname" type="text" placeholder="Last Name" value="{{ Auth::user()->lastname }}" prev-value="{{ Auth::user()->lastname }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <small>Username</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-username" name="username" type="text" placeholder="Username" value="{{ Auth::user()->username }}" prev-value="{{ Auth::user()->username }}" disabled>
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
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-email-address" name="email_address" type="text" placeholder="Email Address" value="{{ Auth::user()->email }}" prev-value="{{ Auth::user()->email }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <small>Contact Number</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-contact-number" name="contact_number" type="text" placeholder="Contact Number" value="{{ Auth::user()->contact_number }}" prev-value="{{ Auth::user()->contact_number }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-phone"></i>
                    </div>
                </div>

                <small>Referral Link</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-referral-link" name="referral_code" type="text" placeholder="Referral Link" value="{{ config('app.url') . '/ref/' . Auth::user()->referral_code }}" prev-value="{{ config('app.url') . '/ref/' . Auth::user()->referral_code }}" data-prefix="{{ config('app.url') . '/ref/' }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>

                <small>Address</small>
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="edit-address" name="address" type="text" placeholder="Address" value="{{ Auth::user()->address }}" prev-value="{{ Auth::user()->address }}" disabled>
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6 order-0 order-md-1 px-2">
                <div class="d-flex justify-content-center align-items-center h-100 me-xl-4">
                    <input type="file" name="profile_picture" class="d-none" accept="image/*" data-url="{{ route('profile.updateProfilePicture') }}" />
                    <div class="col-11 col-sm-6 col-md-11 col-lg-10 col-xl-10 col-xxl-9 mt-3 mt-md-0 mb-3 mb-md-0" id="change-profile-picture">
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

        <div class="text-center mt-5 mb-4">
            <button class="btn btn-custom-2" id="cancel" style="background-color:#0e4d22; color:#ffffff; width:205px; display:none">Cancel</button>
            <button class="btn btn-custom-2" id="edit-personal-info" style="background-color:#0e4d22; color:#ffffff; width:205px; display:none">Save Changes</button>
        </div>
    </div>
</main>

<div class="modal fade" id="modal-reset-password" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Reset Password</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="send-reset-password-link-route" value="{{ route('profile.sendResetPasswordLink') }}" />

                <div class="text-center">
                    <div class="spinner-grow mb-2" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                    <p>Sending reset password link to <span class="fw-bold" id="reset-password-link-email">{{ Auth::user()->email }}</span>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
