@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Winners Gem Purchases</h6>
    </div>

    <div class="animated fadeIn">
        <ul class="nav nav-tabs mb-4" role="tab-list">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="pending">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="approved">Approved</a>
            </li>
        </ul>

        <input type="hidden" id="approve-gem-purchase-route" value="{{ route('admin.winnersGem.approvePurchase') }}" />
        <input type="hidden" id="remove-gem-purchase-route" value="{{ route('admin.winnersGem.removePurchase') }}" />

        <div id="winners-gem-table-container" class="mb-5">
            @include('admin.winnersGem.includes.winnersGemTable')
        </div>
    </div>
</main>

<div class="modal fade" id="modal-proof-of-payment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Proof of Payment | <span id="account-name"></span></h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row mt-2 no-gutters" id="proof-of-payment-container" style="margin-left:-4px; margin-right:-4px"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
