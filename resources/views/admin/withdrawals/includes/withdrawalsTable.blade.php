<div class="tab-content pt-2">
    <div class="tab-pane fade in show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
        <input type="hidden" id="set-as-complete-route" value="{{ route('admin.withdrawals.setAsComplete') }}" />

        <div class="table-responsive font-size-90 mt-1">
            <p class="text-center py-5 my-5 loading-text">Loading...</p>
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th></th>
                        <th>Date&nbsp;&amp; Time Requested</th>
                        <th>Account</th>
                        <th>Amount</th>
                        <th>Fee</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawals as $withdrawal)
                        @if(!$withdrawal['date_time_completed'])
                    <tr>
                        <td class="text-center">
                            <button class="btn btn-custom-2 btn-sm font-size-90 mt-1 withdrawal-set-as-complete-confirm" value="{{ $withdrawal["id"] }}">Set as complete</button>
                            <button class="btn btn-custom-2 btn-sm font-size-90 mt-1 view-payout-information">Payout Information<span style="display:none">{{ $withdrawal["payout_information"] }}</span></button>
                        </td>
                        <td>{{ formatDate($withdrawal["created_at"]) }}</td>
                        <td>{{ fullName($withdrawal) }}</td>
                        <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($withdrawal["amount"],2) }}</td>
                        <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($withdrawal["fee"],2) }}</td>
                    </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
        <div class="table-responsive font-size-90 mt-4">
            <p class="text-center py-5 my-5 loading-text">Loading...</p>
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th></th>
                        <th>Date &amp; Time Requested</th>
                        <th>Date &amp; Time Completed</th>
                        <th>Account</th>
                        <th>Amount</th>
                        <th>Fee</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawals as $withdrawal)
                        @if($withdrawal['date_time_completed'])
                    <tr>
                        <td class="text-center">
                            <button class="btn btn-custom-2 btn-sm font-size-90 view-payout-information">Payout Information<span style="display:none">{{ $withdrawal["payout_information"] }}</span></button>
                        </td>
                        <td>{{ formatDate($withdrawal["created_at"]) }}</td>
                        <td>{{ formatDate($withdrawal["date_time_completed"]) }}</td>
                        <td>{{ fullName($withdrawal) }}</td>
                        <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($withdrawal["amount"],2) }}</td>
                        <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($withdrawal["fee"],2) }}</td>
                    </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
