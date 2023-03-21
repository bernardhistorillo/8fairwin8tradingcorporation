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
@endsection
