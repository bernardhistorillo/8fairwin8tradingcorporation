@extends('layouts.app')

@section('title', 'Admin Orders')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Income Distribution</h6>
    </div>

    <div class="animated fadeIn">
        <div class="table-responsive font-size-90 mt-1">
            <p class="text-center py-5 my-5 loading-text">Loading...</p>
            <table class="table table-bordered data-table d-none">
                <thead>
                <tr>
                    <th></th>
                    <th>Date &amp; Time Placed</th>
                    <th>Type</th>
                    <th>Reference</th>
                    <th>Account</th>
                    <th>Price</th>
                    <th>Points</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    @if(!$order["date_time_completed"])
                        <tr>
                            <td class="pt-2">
                                <div class="d-flex justify-content-center align-items-center flex-wrap flex-xl-nowrap">
                                    <div class="me-1 mb-1 mb-xl-0">
                                        <button class="btn btn-custom-2 btn-sm font-size-90 view-items" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}">Items</button>
                                    </div>
                                    <div class="me-xl-1 mb-1 mb-xl-0">
                                        <button class="btn btn-custom-2 btn-sm font-size-90 view-shipment" data-reference="{{ $order["reference"] }}" data-full-name="{{ $order["full_name"] }}" data-contact-number="{{ $order["contact_number"] }}" data-barangay="{{ $order["barangay"] }}" data-city="{{ $order["city"] }}" data-province="{{ $order["province"] }}" data-zip-code="{{ $order["zip_code"] }}">Shipment</button>
                                    </div>
                                    @if($order["terminal_user_id"] == 0)
                                        <div class="">
                                            <button class="btn btn-custom-2 btn-sm font-size-90 mark-order-as-complete-confirm" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}" data-from="admin">Mark&nbsp;as&nbsp;Complete</button>
                                        </div>
                                    @else
                                        <div class="">
                                            <button class="btn btn-custom-2 btn-sm font-size-90 show-stockist" data-name="{{ $stockists[$order["terminal_user_id"]]["name"] }}" data-rank="{{ $stockists[$order["terminal_user_id"]]["rank"] }}" data-email-address="{{ $stockists[$order["terminal_user_id"]]["email_address"] }}">Stockist</button>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>{{ formatDate($order["created_at"]) }}</td>
                            <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                            <td>{{ $order["reference"] }}</td>
                            <td>
                                <div>{{ fullName($order) }}</div>
                                @if($order["order_stockist"] > 0 || $order["account_stockist"] > 0)
                                    <div style="font-style:italic; font-size:0.9em">(As {{ $stockistLabels[$order["order_stockist"]] }})</div>
                                @endif
                            </td>
                            <td class="text-end">{{ number_format($order["price"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                            <td class="text-end">{{ number_format($order["points_value"],2) }} PV</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@include('orders.includes.modalViewOrderItems')
@include('orders.includes.modalViewShipment')

@endsection
