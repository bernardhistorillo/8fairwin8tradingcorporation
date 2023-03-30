@extends('layouts.app')

@section('title', 'Income')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Products</h6>
    </div>

    <div class="animated fadeIn pt-2 pb-5">
        @if(Auth::user()->stockist > 0)
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-user me-2"></i> Purchase as:</div>
            <div class="card-body px-4">
                <div class="custom-control custom-radio custom-control-inline mb-1 mb-sm-0 d-block d-sm-inline-block">
                    <input type="radio" id="stockist-purchase-0" name="stockist-purchase" value="0" class="custom-control-input" checked/>
                    <label class="custom-control-label" for="stockist-purchase-0" style="cursor:pointer">Reseller</label>
                </div>
                @if(Auth::user()->stockist == 1)
                <div class="custom-control custom-radio custom-control-inline d-block d-sm-inline-block ml-sm-1">
                    <input type="radio" id="stockist-purchase-1" name="stockist-purchase" value="1" class="custom-control-input"/>
                    <label class="custom-control-label" for="stockist-purchase-1" style="cursor:pointer">Mobile Stockist</label>
                </div>
                @elseif(Auth::user()->stockist == 2)
                <div class="custom-control custom-radio custom-control-inline d-block d-sm-inline-block ml-sm-1">
                    <input type="radio" id="stockist-purchase-2" name="stockist-purchase" value="2" class="custom-control-input"/>
                    <label class="custom-control-label" for="stockist-purchase-2" style="cursor:pointer">Center Stockist</label>
                </div>
                @endif
            </div>
        </div>
        @endif

        @include('products.includes.productsContent')
    </div>
</main>
@endsection
