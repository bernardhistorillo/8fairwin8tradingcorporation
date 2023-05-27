@extends('layouts.app')

@section('title', 'Admin Orders')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Orders</h6>
    </div>

    <div class="animated fadeIn">
        <ul class="nav nav-tabs mb-4" role="tab-list">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="pending">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="approved" aria-selected="completed">Completed</a>
            </li>
        </ul>

        <div id="orders-table-container" class="mb-5">
            @include('admin.orders.includes.ordersTable')
        </div>
    </div>
</main>

@include('orders.includes.modalViewOrderItems')
@include('orders.includes.modalViewShipment')

@endsection
