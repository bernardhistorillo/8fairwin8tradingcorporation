@extends('layouts.app')

@section('title', 'Withdrawals')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Terminal</h6>
    </div>

    <div class="animated fadeIn" id="terminal-select-account-container">
        <div class="card mb-4">
            <div class="card-body p-3 d-flex align-items-center">
                <i class="fa fa-gem p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                <div>
                    <div class="text-value-sm" style="color:#0e4d22; font-size:1.5em"><span id="terminal-winners-gem">{{ number_format(Auth::user()->terminalWinnersGem()["balance"], 2) }}</span> <i class="fas fa-gem gem-change-color" style="font-size:0.8em"></i></div>
                    <div class="text-muted text-uppercase font-weight-bold small">Winners Gem</div>
                </div>
            </div>
        </div>

        <nav class="nav nav-pills nav-fill mb-4">
            <a class="nav-item nav-link me-2" href="{{ route('terminal.index') }}" style="border:1px solid #bbbbbb; padding-top:12px; {{ ($terminal['type'] == "place-order") ? "background-color:#0e4d22; color:#ffffff" : "background-color:#f3f7f0; color:#0e4d22" }}"><i class="fas fa-store fa-2x"></i><br><span style="font-weight:500">Place an Order</span></a>
            <a class="nav-item nav-link mx-2" href="{{ route('terminal.index', 'orders') }}" style="border:1px solid #bbbbbb; padding-top:12px; {{ ($terminal['type'] == "orders") ? "background-color:#0e4d22; color:#ffffff" : "background-color:#f3f7f0; color:#0e4d22" }}"><i class="fas fa-shopping-bag fa-2x"></i><br><span style="font-weight:500">Orders</span></a>
            <a class="nav-item nav-link ms-2" href="{{ route('terminal.index', 'inventory') }}" style="border:1px solid #bbbbbb; padding-top:12px; {{ ($terminal['type'] == "inventory") ? "background-color:#0e4d22; color:#ffffff" : "background-color:#f3f7f0; color:#0e4d22" }}"><i class="fas fa-list-alt fa-2x"></i><br><span style="font-weight:500">Inventory</span></a>
        </nav>

        @if(!$terminalUser)
            @if($terminal['type'] == 'place-order')
        <div class="card mb-5">
            <div class="card-header bg-color-5"><i class="fas fa-user me-2"></i> Select Account:</div>
            <div class="card-body">
                <div class="table-responsive font-size-90">
                    <h6 class="text-center my-5 loading-text">Loading...</h6>
                    <table class="table table-bordered data-table" style="display:none">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email Address</th>
                                <th class="text-center">Referral Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($terminalUsers as $terminalUser)
                            <tr>
                                <td><a href="{{ route('terminal.index', ['terminalUser' => base64_encode($terminalUser["id"])]) }}" class="btn btn-custom-2 btn-sm font-size-90 px-3">Select</a></td>
                                <td>{{ fullName($terminalUser) }}</td>
                                <td>{{ $terminalUser["email"] }}</td>
                                <td>{{ $terminalUser["referral_code"] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @elseif($terminal['type'] == "orders")
        <ul class="nav nav-tabs custom-nav-tabs mb-3" role="tab-list">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="pending">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="completed">Completed</a>
            </li>
        </ul>

        <input type="hidden" id="mark-order-as-complete-route" value="{{ route('orders.markOrderAsComplete') }}" />

        <div class="tab-content pt-2 mb-5">
            <div class="tab-pane fade in show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="table-responsive mt-1">
                    <h6 class="text-center py-5 my-5 loading-text">Loading...</h6>
                    <table class="table table-bordered data-table font-size-90" style="display:none">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Date&nbsp;&amp; Time Placed</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Reference</th>
                                <th class="text-center">Account</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                @if(!$order["date_time_completed"])
                            <tr>
                                <td class="pt-2">
                                    <button class="btn btn-custom-2 btn-sm mt-1 font-size-90 view-items" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}" style="width:83px">Items</button>
                                    <button class="btn btn-custom-2 btn-sm mt-1 font-size-90 terminal-view-shipment" data-reference="{{ $order["reference"] }}" data-full-name="{{ $order["full_name"] }}" data-contact-number="{{ $order["contact_number"] }}" data-barangay="{{ $order["barangay"] }}" data-city="{{ $order["city"] }}" data-province="{{ $order["province"] }}" data-zip-code="{{ $order["zip_code"] }}" style="width:82px">Shipment</button>
                                    <button class="btn btn-custom-2 btn-sm mt-1 font-size-90 mark-order-as-complete-confirm" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}" style="width:168px">Mark as Complete</button>
                                </td>
                                <td>{{ formatDate($order["created_at"]) }}</td>
                                <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                                <td>{{ $order["reference"] }}</td>
                                <td>{{ fullName($order) }}</td>
                                <td>{{ number_format($order["price"], 2) }} <i class="fas fa-gem gem-change-color"></i></td>
                                <td>{{ number_format($order["points_value"], 2) }} PV</td>
                            </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="approved-tab">
                <div class="table-responsive mt-4">
                    <h6 class="text-center py-5 my-5 loading-text">Loading...</h6>
                    <table class="table table-bordered data-table font-size-90" style="display:none">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Date&nbsp;&amp; Time Placed</th>
                                <th class="text-center">Date&nbsp;&amp; Completed</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Reference</th>
                                <th class="text-center">Account</th>
                                <th class="text-center">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                @if($order["date_time_completed"])
                            <tr>
                                <td>
                                    <button class="btn btn-custom-2 btn-sm font-size-90 mt-1 view-items" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}" style="width:82px">Items</button>
                                    <button class="btn btn-custom-2 btn-sm font-size-90 mt-1 terminal-view-shipment" data-reference="{{ $order["reference"] }}" data-full-name="{{ $order["full_name"] }}" data-contact-number="{{ $order["contact_number"] }}" data-barangay="{{ $order["barangay"] }}" data-city="{{ $order["city"] }}" data-province="{{ $order["province"] }}" data-zip-code="{{ $order["zip_code"] }}" style="width:82px">Shipment</button>
                                </td>
                                <td>{{ formatDate($order["created_at"]) }}</td>
                                <td>{{ formatDate($order["date_time_completed"]) }}</td>
                                <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                                <td>{{ $order["reference"] }}</td>
                                <td>{{ fullName($order) }}</td>
                                <td>{{ number_format($order["price"], 2) }} <i class="fa-solid fa-gem gem-change-color"></i></td>
                            </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @elseif($terminal['type'] == "inventory")
        <div class="table-responsive mb-5">
            <h6 class="text-center my-5 loading-text">Loading...</h6>
            <table class="table table-bordered" id="items-table" style="display:none">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Name</th>
                        <th class="text-center">In Stock</th>
                        <th class="text-center">Pending Order</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $key => $item)
                    <tr>
                        <td class="text-center" style="width:10%">
                            <a href="{{ $item->photo() }}" class="d-inline-block" style="width:60px; height:60px" data-fancybox="images" data-caption="{{ $item["name"] }}">
                                <div class="background-image-contain" style="width:60px; height:60px; background-image:url('{{ $item["photo"] }}')"></div>
                            </a>
                        </td>
                        <td>{{ $item["name"] }}</td>
                        <td style="width:10%">{{ number_format($item["terminalItemStock"]["inStock"]) }}</td>
                        <td style="width:10%">{{ number_format($item["terminalItemStock"]["pending"]) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            @endif
        @else
        <a href="{{ route('terminal.index') }}" class="btn btn-custom-2 btn-sm px-3 mb-3"><i class="fas fa-arrow-left" style="font-size:1em"></i>&nbsp;&nbsp;Go Back</a>

        <div class="card mb-4">
            <div class="card-header bg-color-5"><i class="fas fa-user me-2"></i> Account</div>
            <div class="card-body p-3 d-flex align-items-center">
                <div class="table-responsive">
                    <table class="table table-bordered mb-1">
                        <tr>
                            <th class="text-right" style="background-color:#f0f3f5; width:150px">Name</th>
                            <td class="text-left">{{ fullName($terminalUser) }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="background-color:#f0f3f5">Rank Status</th>
                            <td class="text-left">{{ $terminalUser->packageAndRank() }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="background-color:#f0f3f5">Email Address</th>
                            <td class="text-left">{{ $terminalUser["email"] }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="background-color:#f0f3f5">Referral Code</th>
                            <td class="text-left">{{ $terminalUser["referral_code"] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="mb-5">
            @include("products.includes.productsContent")
        </div>

        @endif
    </div>
</main>

<div class="modal fade" id="modal-view-shipment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Shipment - Order: <span class="order-reference"></span></h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <div class="table-responsive mt-2">
                    <table class="table table-bordered mb-1">
                        <tr>
                            <th style="width:50%; background-color:#fafafa; text-align:right">Full Name</th>
                            <td id="shipment-full-name" style="text-align:left"></td>
                        </tr>
                        <tr>
                            <th style="background-color:#fafafa; text-align:right">Contact Number</th>
                            <td id="shipment-contact-number" style="text-align:left"></td>
                        </tr>
                        <tr>
                            <th style="background-color:#fafafa; text-align:right">Barangay</th>
                            <td id="shipment-barangay" style="text-align:left"></td>
                        </tr>
                        <tr>
                            <th style="background-color:#fafafa; text-align:right">City</th>
                            <td id="shipment-city" style="text-align:left"></td>
                        </tr>
                        <tr>
                            <th style="background-color:#fafafa; text-align:right">Province</th>
                            <td id="shipment-province" style="text-align:left"></td>
                        </tr>
                        <tr>
                            <th style="background-color:#fafafa; text-align:right">Zip Code</th>
                            <td id="shipment-zip-code" style="text-align:left"></td>
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
@endsection
