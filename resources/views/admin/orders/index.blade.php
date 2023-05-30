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

<div class="modal fade" id="modal-stockist" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Stockist</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-1">
                        <tr>
                            <th class="text-end">Name</th>
                            <td id="stockist-name"></td>
                        </tr>
                        <tr>
                            <th class="text-end">Rank</th>
                            <td id="stockist-rank"></td>
                        </tr>
                        <tr>
                            <th class="text-end">Email Address</th>
                            <td id="stockist-email-address"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-2 px-4 proceed" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@include('orders.includes.modalViewOrderItems')
@include('orders.includes.modalViewShipment')

@endsection
