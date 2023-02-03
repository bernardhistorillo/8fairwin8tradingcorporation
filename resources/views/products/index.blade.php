@extends('layouts.app')

@section('title', 'Income')

@section('content')
<main class="main">
    <div class="d-flex">
        <ol class="breadcrumb flex-fill">
            <li class="breadcrumb-item active">Products</li>
        </ol>

        <ol class="breadcrumb text-white" style="background-color:#2f353a">
            <li class="breadcrumb-item">
                <i class="fas fa-gem"></i> <span class="px-1">:</span>
                &#8369;&nbsp;{{ number_format(winnersGemValue(), 2) }}
            </li>
        </ol>
    </div>

    <div class="container-fluid pb-5">
        <div class="animated fadeIn">
            @if(Auth::user()->stockist > 0)
            <div class="card">
                <div class="card-header"><i class="fas fa-user"></i> Purchase as:</div>
                <div class="card-body px-4">
                    <div
                        class="custom-control custom-radio custom-control-inline mb-1 mb-sm-0 d-block d-sm-inline-block">
                        <input type="radio" id="stockist-purchase-0" name="stockist-purchase" value="0" class="custom-control-input" checked/>
                        <label class="custom-control-label" for="stockist-purchase-0" style="cursor:pointer">Reseller</label>
                    </div>
                    @if(Auth::user()->stockist == 1)
                    <div
                        class="custom-control custom-radio custom-control-inline d-block d-sm-inline-block ml-sm-1">
                        <input type="radio" id="stockist-purchase-1" name="stockist-purchase" value="1" class="custom-control-input"/>
                        <label class="custom-control-label" for="stockist-purchase-1" style="cursor:pointer">Mobile Stockist</label>
                    </div>
                    @elseif(Auth::user()->stockist == 2)
                    <div
                        class="custom-control custom-radio custom-control-inline d-block d-sm-inline-block ml-sm-1">
                        <input type="radio" id="stockist-purchase-2" name="stockist-purchase" value="2" class="custom-control-input"/>
                        <label class="custom-control-label" for="stockist-purchase-2" style="cursor:pointer">Center Stockist</label>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            @include('products.includes.productsContent')
        </div>
    </div>
</main>

@include('products.includes.modalGemPurchase')

@endsection
