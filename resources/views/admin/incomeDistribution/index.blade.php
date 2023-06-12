@extends('layouts.app')

@section('title', 'Admin Orders')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Income Distribution</h6>
    </div>

    <div class="animated fadeIn">
        @foreach($orders as $order)
        <div class="card border-radius-0 mb-5">
            <div class="card-body">
                <div class="table-responsive font-size-90">
                    <table class="table table-bordered">
                        <tr>
                            <th>Date &amp; Time Placed</th>
                            <th>Type</th>
                            <th>Reference</th>
                            <th>Account</th>
                            <th>Price</th>
                            <th>Points</th>
                        </tr>
                        <tr>
                            <td>{{ formatDate($order["created_at"]) }}</td>
                            <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                            <td>{{ $order["reference"] }}</td>
                            <td>{{ fullName($order) }}</td>
                            <td class="text-end">{{ number_format($order["price"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                            <td class="text-end">{{ number_format($order["points_value"],2) }} PV</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>

@include('orders.includes.modalViewOrderItems')
@include('orders.includes.modalViewShipment')

@endsection
