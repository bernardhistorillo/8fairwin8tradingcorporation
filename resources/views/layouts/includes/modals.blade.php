<div class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-body text-center py-3">
                <div class="pt-2">
                    <i class="fa-regular fa-check-circle font-size-450 text-color-2 mb-3"></i>
                </div>
                <p class="message mb-0"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-2 font-size-90 px-4 proceed" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-warning" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-body text-center py-3">
                <div class="pt-2">
                    <i class="fa-regular fa-exclamation-circle font-size-450 text-color-1 mb-3"></i>
                </div>
                <p class="message mb-0"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-6 font-size-90 px-4 cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-1 font-size-90 px-4 proceed">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-body text-center py-3">
                <div class="pt-2">
                    <i class="fa-regular fa-exclamation-circle font-size-450 text-color-4 mb-3"></i>
                </div>
                <p class="message mb-0"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-4 font-size-90 px-4 proceed" data-bs-dismiss="modal">Okay</button>
            </div>
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
                <p class="mb-0">You're email address must be verified before you can proceed.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-4 font-size-90 px-4 verify-email-show-modal" data-bs-dismiss="modal" value="{{ route('profile.sendEmailOTP') }}">Verify Email Now</button>
            </div>
        </div>
    </div>
</div>
