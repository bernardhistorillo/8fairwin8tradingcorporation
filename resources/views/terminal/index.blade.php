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
                                <td class="text-center"><a href="{{ route('terminal.index', ['terminalUser' => base64_encode($terminalUser["id"])]) }}" class="btn btn-custom-2 btn-sm font-size-90 px-3">Select</a></td>
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

        <div class="tab-content pt-2 mb-5" id="orders-table-container">
            @include('terminal.includes.ordersTable')
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
                                <div class="background-image-contain" style="width:60px; height:60px; background-image:url('{{ $item->photo() }}')"></div>
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

@include('orders.includes.modalViewShipment')
@include('orders.includes.modalViewOrderItems')

@endsection
