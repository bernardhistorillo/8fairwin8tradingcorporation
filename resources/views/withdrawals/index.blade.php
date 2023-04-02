@extends('layouts.app')

@section('title', 'Withdrawals')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Withdrawals</h6>
        <div>
            <button class="btn btn-custom-2 btn-sm px-4" data-bs-toggle="modal" data-bs-target="#modal-withdraw">Withdraw</button>
        </div>
    </div>

    <div class="animated fadeIn pt-2 pb-5">
        <div class="table-responsive font-size-90">
            <h5 class="text-center py-5 my-5 loading-text">Loading...</h5>
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Date&nbsp;&amp; Time Requested</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Fee</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($withdrawals as $withdrawal)
                <tr>
                    <td><button class="btn btn-custom-2 btn-sm font-size-90 view-payout-information">Payout Information<span style="display:none">{{ $withdrawal["payout_information"] }}</span></button></td>
                    <td>{{ \Carbon\Carbon::parse($withdrawal["created_at"])->isoFormat('llll') }}</td>
                    <td><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($withdrawal["amount"], 2) }}</td>
                    <td><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($withdrawal["fee"], 2) }}</td>
                    <td style="color:#ffffff" class="{{ ($withdrawal["date_time_completed"]) ? 'bg-color-2' : 'bg-color-1' }}">{!! (!$withdrawal["date_time_completed"]) ? 'Pending' : 'Completed<br>' . $withdrawal["date_time_completed"] !!}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<div class="modal fade" id="modal-payout-information" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Payout Information</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="responsive" id="payout-information-container"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-2 cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@include('withdrawals.includes.modalWithdraw')
@endsection
