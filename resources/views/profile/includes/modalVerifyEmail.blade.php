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
                        <input class="form-control form-control-1 text-center px-5 py-2 numeric-only" name="otp" type="text" placeholder="Enter One-Time Pin" style="letter-spacing: 5px" required />
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
