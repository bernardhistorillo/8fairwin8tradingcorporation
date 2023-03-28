@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Orders</h6>
    </div>

    <div class="animated fadeIn pt-2 pb-5">
        <ul class="nav nav-tabs mb-4" role="tab-list">
            <li class="nav-item">
                <a class="nav-link {{ ($orders['type'] == 'products') ? 'active' : '' }}" href="{{ route('orders.index', 'products') }}" style="{{ ($orders['type'] == 'products') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}"><i class="fas fa-gift me-2"></i> Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($orders['type'] == 'winnersgem') ? 'active' : '' }}" href="{{ route('orders.index', 'winnersgem') }}" style="{{  ($orders['type'] == 'winnersgem') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}"><i class="fas fa-gem me-2"></i> Winners Gem</a>
            </li>
        </ul>

        <div class="table-responsive font-size-90">
            @if($orders['type'] == 'products')
            <input type="hidden" id="view-items-route" value="{{ route('orders.viewItems') }}" />
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                <tr>
                    <th></th>
                    <th class="text-center">Date&nbsp;&amp; Time Placed</th>
                    <th class="text-center">Reference</th>
                    <th class="text-center">Total Amount</th>
                    <th class="text-center">Total Points Value</th>
                    <th class="text-center">Status</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($orders['products'] as $item)
                    <tr>
                        <td><button class="btn btn-custom-2 btn-sm font-size-90 view-items" value="{{ $item['id'] }}" data-reference="{{ $item['reference'] }}">View Items</button></td>
                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                        <td>{{ $item['reference'] }}</td>
                        <td>{{ number_format($item['price'], 2) }} <i class="fas fa-gem gem-change-color" style="font-size:0.8em"></i></td>
                        <td>{{ number_format($item['points_value'], 2) }} PV</td>
                        <td class="{{ ($item["date_time_completed"]) ? "bg-color-2" : "bg-warning" }}" style="color:#ffffff">{!! ($item["date_time_completed"]) ? "Completed<br>" . \Carbon\Carbon::parse($item["date_time_completed"])->isoFormat('llll') : "Pending" !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif($orders['type'] == 'winnersgem')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Date&nbsp;&amp; Time Requested</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders['winnersGem'] as $item)
                    <tr>
                        <td><button class="btn btn-custom-2 btn-sm font-size-90 update-proof-of-payment" value="{{ $item['id'] }}">Update Proof of Payment<span style="display:none">{{ $item['proof_of_payment'] }}</span></button></td>
                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                        <td>{{ number_format($item['amount'], 2) }} <i class="fas fa-gem gem-change-color" style="font-size:0.8em"></i></td>
                        <td>&#8369;&nbsp;{{ number_format($item['price'], 2) }}</td>
                        <td class="{{ ($item["date_time_approved"]) ? "bg-color-2" : "bg-color-1" }}" style="color:#ffffff">{!! ($item["date_time_approved"]) ? "Completed<br>" . \Carbon\Carbon::parse($item["date_time_approved"])->isoFormat('llll') : "Pending" !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</main>

<div class="modal fade" id="modal-view-order-items" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Order: <span id="order-reference"></span></h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive" id="ordered-items-container"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-2 px-4 proceed" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-proof-of-payment-update" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title">Update Proof of Payment</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <input type="hidden" id="update-proof-of-payment" value="{{ route('orders.updateProofOfPayment') }}">
                <div class="row justify-content-center mt-2 no-gutters" id="proof-of-payment-container" style="margin-left:-4px; margin-right:-4px">
                    <div class="col-6 px-1" style="margin-bottom:10px">
                        <div class="proof-of-payment" data-has-image="0" style="width:100%; height:154px; border:2px solid #0e4d22; position:relative; cursor:pointer">
                            <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%)">
                                <i class="fas fa-plus-circle fa-3x" style="color:#0e4d22"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="proof-of-payment-content" class="d-none">
                    <div class="col-6 px-1" style="margin-bottom:10px">
                        <div class="proof-of-payment" data-has-image="0" style="width:100%; height:154px; border:2px solid #0e4d22; position:relative; cursor:pointer">
                            <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%)">
                                <i class="fa-light fa-plus-circle fa-3x" style="color:#0e4d22"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal" style="width:170px">Cancel</button>
                <button type="button" class="btn btn-custom-2 px-4" id="update-proof-of-payment-confirm" style="width:170px">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
