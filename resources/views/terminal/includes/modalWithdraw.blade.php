<div class="modal fade" id="modal-withdraw" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Withdraw</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="submit-withdrawal-route" value="{{ route('withdrawals.submitWithdrawal') }}" />

                <div class="form-group">
                    <label class="withdraw-amount-label" for="withdraw-amount">Enter Amount <small>(Minimum: &#x20B1; 500.00)</small></label>

                    <div class="position-relative mb-3">
                        <input class="form-control form-control-1 px-5 py-2 text-center" id="withdraw-amount" type="number" step="any" min="500" value="500" placeholder="Enter Amount">
                        <div class="position-absolute" style="right:20px; top:9px">
                            <i class="fa-solid fa-peso-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr style="background-color:#fafafa">
                                <th>Fee (1%)</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="withdraw-transaction-fee"><i class="fa-solid fa-peso-sign"></i> 5.00</td>
                                <td id="withdraw-total"><i class="fa-solid fa-peso-sign"></i> 505.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h6 class="mt-4">Payout Information</h6>
                @if($validPayoutInformation)
                <div class="responsive">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th class="px-3" style="background-color:#fafafa; text-align:right">Method</th>
                                <td class="w-100 px-3" style="text-align:left">{{ $payoutInformation["method"] }}</td>
                            </tr>
                            @if($payoutInformation["method"] == "BDO")
                            <tr>
                                <th class="px-3" style="background-color:#fafafa; text-align:right">Account&nbsp;Number</th>
                                <td class="w-100 px-3" style="text-align:left">{{ $payoutInformation["account_number"] }}</td>
                            </tr>
                            <tr>
                                <th class="px-3" style="background-color:#fafafa; text-align:right">Account&nbsp;Name</th>
                                <td class="w-100 px-3" style="text-align:left">{{ $payoutInformation["account_name"] }}</td>
                            </tr>
                            @elseif($payoutInformation["method"] == "Palawan Express")
                            <tr>
                                <th class="px-3" style="background-color:#fafafa; text-align:right">Name</th>
                                <td class="w-100 px-3" style="text-align:left">{{ $payoutInformation["name"] }}</td>
                            </tr>
                            <tr>
                                <th class="px-3" style="background-color:#fafafa; text-align:right">Mobile&nbsp;Number</th>
                                <td class="w-100 px-3" style="text-align:left">{{ $payoutInformation["mobile_number"] }}</td>
                            </tr>
                            @elseif($payoutInformation["method"] == "GCash")
                            <tr>
                                <th class="px-3" style="background-color:#fafafa; text-align:right">Mobile Number</th>
                                <td class="w-100 px-3" style="text-align:left">{{ $payoutInformation["mobile_number"] }}</td>
                            </tr>
                            @elseif($payoutInformation["method"] == "Coins.ph")
                            <tr>
                                <th class="px-3" style="background-color:#fafafa; text-align:right">Wallet&nbsp;Address</th>
                                <td class="w-100 px-3" style="text-align:left">{{ $payoutInformation["wallet_address"] }}</td>
                            </tr>
                           @endif
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-danger">
                    <p class="text-center mb-3">Finish setting up your payout information to proceed.</p>
                    <div class="text-center mb-2"><a href="account.php" class="btn btn-danger">Proceed to Account Settings</a></div>
                </div>
                @endif
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-2 px-4 proceed" id="withdraw-confirm" {{ (!$validPayoutInformation) ? 'disabled' : '' }}>Withdraw</button>
            </div>
        </div>
    </div>
</div>
