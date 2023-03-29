<div class="modal fade" id="modal-transfer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Transfer Winners Gem</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="check-receiver-route" value="{{ route('transfers.checkReceiver') }}" />

                <small>Winners Gem Amount (Minimum: 1.00 <i class="fas fa-gem" style="font-size:0.8em"></i>)</small>
                <div class="position-relative mb-3">
                    <input class="form-control form-control-1 text-center px-5 py-2" id="transfer-winners-gem-amount" type="number" placeholder="Winners Gem Amount" value="1">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fa-solid fa-gem"></i>
                    </div>
                </div>

                <small>Receiver's Username</small>
                <div class="position-relative mb-3">
                    <input class="form-control form-control-1 text-center px-5 py-2" id="transfer-receiver-username" type="text" placeholder="Enter Receiver's Username">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>

                <small>Winners Gem Pin Code</small>
                <div class="position-relative mb-3">
                    <input class="form-control form-control-1 text-center px-5 py-2" id="transfer-pin-code" type="text" placeholder="Enter Your Winners Gem Pin Code">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                </div>

                <p class="text-center mb-1">
                    Receiver:
                    <span id="transfer-receiver-blank" class="text-color-1" style="font-weight:bold; font-style:italic; display:inline-block">(Enter Receiver's Username)</span>
                    <span id="transfer-receiver-no-match" class="text-color-4" style="font-weight:bold; font-style:italic; display:none">(Username didn't match any account)</span>
                    <span id="transfer-receiver-has-match" class="text-color-2" style="font-weight:bold; display:none"></span>
                    <span id="transfer-receiver-loading" style="font-weight:bold; font-style:italic; display:none">Loading...</span>
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-2 px-4" id="transfer-winners-gem-confirm">Transfer</button>
            </div>
        </div>
    </div>
</div>
