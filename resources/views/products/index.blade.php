@extends('layouts.app')

@section('title', 'Income')

@section('content')
<main class="main">
    <div class="d-flex">
        <ol class="breadcrumb flex-fill">
            <li class="breadcrumb-item active">Orders</li>
        </ol>

        <ol class="breadcrumb text-white" style="background-color:#2f353a">
            <li class="breadcrumb-item">
                <i class="fas fa-gem"></i> <span class="px-1">:</span> &#8369;&nbsp;{{ number_format(winnersGemValue(), 2) }}
            </li>
        </ol>
    </div>

    <div class="container-fluid pb-5">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" role="tab-list">
                        <li class="nav-item">
                            <a class="nav-link {{ ($orders['type'] == 'products') ? 'active' : '' }}" href="{{ route('orders.index', 'products') }}" style="{{ ($orders['type'] == 'products') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}"><i class="fas fa-gift"></i> Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($orders['type'] == 'winnersgem') ? 'active' : '' }}" href="{{ route('orders.index', 'winnersgem') }}" style="{{  ($orders['type'] == 'winnersgem') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}"><i class="fas fa-gem"></i> Winners Gem</a>
                        </li>
                    </ul>

                    <div class="table-responsive">
                        @if($orders['type'] == 'products')
                        <table class="table table-bordered data-table" style="display:none">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Date&nbsp;&amp; Time Placed</th>
                                <th>Reference</th>
                                <th>Total Amount</th>
                                <th>Total Points Value</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders['products'] as $item)
                                <tr>
                                    <td><button class="btn btn-success btn-sm view-items" value="{{ $item['id'] }}" data-reference="{{ $item['reference'] }}" style="background-color:#0e4d22">View Items</button></td>
                                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                                    <td>{{ $item['reference'] }}</td>
                                    <td>{{ number_format($item['price'], 2) }} <i class="fas fa-gem" style="font-size:0.8em"></i></td>
                                    <td>{{ number_format($item['points_value'], 2) }} PV</td>
                                    <td class="{{ ($item["date_time_completed"]) ? "bg-success" : "bg-warning" }}" style="color:#ffffff">{!! ($item["date_time_completed"]) ? "Completed<br>" . \Carbon\Carbon::parse($item["date_time_completed"])->isoFormat('llll') : "Pending" !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif($orders['type'] == 'winnersgem')
                        <table class="table table-bordered data-table" style="display:none">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Date&nbsp;&amp; Time Requested</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders['winnersGem'] as $item)
                                <tr>
                                    <td><button class="btn btn-success update-proof-of-payment" value="{{ $item['id'] }}" style="background-color:#0e4d22; color:#ffffff">Update Proof of Payment<span style="display:none">{{ $item['proof_of_payment'] }}</span></button></td>
                                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                                    <td>{{ number_format($item['amount'], 2) }} <i class="fas fa-gem" style="font-size:0.8em"></i></td>
                                    <td>&#8369;&nbsp;{{ number_format($item['price'], 2) }}</td>
                                    <td class="{{ ($item["date_time_approved"]) ? "bg-success" : "bg-warning" }}" style="color:#ffffff">{!! ($item["date_time_approved"]) ? "Completed<br>" . \Carbon\Carbon::parse($item["date_time_approved"])->isoFormat('llll') : "Pending" !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
