<div class="tab-content pt-2">
    <div class="tab-pane fade in show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
        <div class="table-responsive font-size-90 mt-1">
            <p class="text-center py-5 my-5 loading-text">Loading...</p>
            <table class="table table-bordered data-table d-none">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Date&nbsp;&amp; Time Requested</th>
                            <th>Account</th>
                            <th>Amount</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                <tbody>
                @foreach($gemPurchases as $gemPurchase)
                    @if(!$gemPurchase["date_time_approved"])
                <tr>
                    <td>
                        <div class="d-flex justify-content-center align-items-center flex-wrap flex-lg-nowrap">
                            <div class="me-1 mb-1 mb-lg-0">
                                <button class="btn btn-custom-2 btn-sm font-size-90 approve-gem-purchase-show-modal" value="{{ $gemPurchase["id"] }}">Approve</button>
                            </div>
                            <div class="me-1 mb-1 mb-lg-0">
                                <button class="btn btn-custom-2 btn-sm font-size-90 view-proof-of-payment" data-account="{{ fullName($gemPurchase) }}">Proof&nbsp;of&nbsp;Payment<span style="display:none">{{ $gemPurchase["proof_of_payment"] }}</span></button>
                            </div>
                            <div class="mb-1 mb-lg-0">
                                <button class="btn btn-custom-4 btn-sm font-size-90 remove-gem-purchase-confirm" value="{{ $gemPurchase["id"] }}"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </td>
                    </td>
                    <td>{{ formatDate($gemPurchase["created_at"]) }}</td>
                    <td>{{ fullName($gemPurchase) }}</td>
                    <td class="text-end">{{ number_format($gemPurchase["amount"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                    <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($gemPurchase["price"],2) }}</td>
                </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
        <div class="table-responsive font-size-90 mt-4">
            <p class="text-center py-5 my-5 loading-text">Loading...</p>
            <table class="table table-bordered data-table d-none">
                <thead>
                    <tr>
                        <th></th>
                        <th>Date&nbsp;&amp; Time Requested</th>
                        <th>Date&nbsp;&amp; Time Approved</th>
                        <th>Account</th>
                        <th>Amount</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gemPurchases as $gemPurchase)
                        @if($gemPurchase["date_time_approved"])
                    <tr>
                        <td class="text-center"><button class="btn btn-custom-2 font-size-90 btn-sm view-proof-of-payment" data-account="{{ fullName($gemPurchase) }}">Proof of Payment<span style="display:none">{{ $gemPurchase["proof_of_payment"] }}</span></button></td>
                        <td>{{ $gemPurchase["created_at"] }}</td>
                        <td>{{ $gemPurchase["date_time_approved"] }}</td>
                        <td>{{ fullName($gemPurchase) }}</td>
                        <td class="text-end">{{ number_format($gemPurchase["amount"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                        <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{  number_format($gemPurchase["price"],2) }}</td>
                    </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
