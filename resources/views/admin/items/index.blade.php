@extends('layouts.app')

@section('title', 'Admin Items')

@section('content')
<main class="main">
    @if(!$item)
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Items</h6>

        <div class="">
            <button class="btn btn-custom-1 btn-sm px-4 mb-0" data-bs-toggle="modal" data-bs-target="#add-item-modal">Add Item</button>
        </div>
    </div>
    @else
    <ol class="breadcrumb mt-2">
        <li class="breadcrumb-item">
            <a href="javascript:void(0)" class="link-color-3">Items</a>
        </li>
        <li class="breadcrumb-item active">{{ $item['name'] }}</li>
    </ol>
    @endif

    <div class="animated fadeIn mb-5">
        @if(!$item)
        <div class="table-responsive font-size-90" id="items-table-container">
            <h6 class="text-center my-5 py-5 loading-text">Loading...</h6>
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td class="text-center">
                            <a href="{{ route('admin.items.index', ['item' => $item['id']]) }}" class="btn btn-custom-2 btn-sm font-size-90">View</a>
                        </td>
                        <td class="text-center">
                            <div class="background-image-contain d-inline-block w-100" style="max-width:100px; padding-top:100%; background-image:url('{{ $item->photo() }}')"></div>
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ ($item['type'] == 1) ? "Package" : "Product" }}</td>
                        <td class="text-end">
                            Center Price: {{ number_format($item['center_price'] / $winnersGemValue,2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i><br>
                            Distributor's Price: {{ number_format($item['distributors_price'] / $winnersGemValue,2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i><br>
                            Suggested Retail Price: {{ number_format($item['suggested_retail_price'] / $winnersGemValue,2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i>
                        </td>
                        <td class="text-white text-center {{ ($item["status"] == 0) ? "bg-color-4" : "bg-color-2" }}">{{ ($item["status"] == 0) ? "Inactive" : "Active" }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="row">
            <div class="offset-2 col-8 offset-sm-3 col-sm-6 offset-md-0 col-md-3">
                <div class="background-image-contain w-100" id="photo-container" style="padding-top:100%; background-image:url('{{ $item->photo() }}'); border:1px solid #104d22"></div>
            </div>

            <div class="col-md-9">
                <form id="edit-item-form" action="{{ route('admin.items.editItem') }}">
                    <input type="hidden" name="id" value="{{ $item['id'] }}" />

                    <div class="row">
                        <div class="col-lg-6">
                            <small>Item Name</small>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-1 ps-3 pe-5 py-2" name="name" type="text" placeholder="Item Name" value="{{ $item["name"] }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <small>Type</small>
                            <div class="position-relative mb-3">
                                <select class="form-select form-control-1" name="type">
                                    <option value="-1">Select Type</option>
                                    <option value="1" {{ ($item["type"] == 1) ? 'selected' : '' }}>Package - Quick Start Pack</option>
                                    <option value="2" {{ ($item["type"] == 2) ? 'selected' : '' }}>Product</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <small for="item-photo" class="form-label">Display Image</small>
                            <div class="form-control-1 mb-3">
                                <input class="form-control" type="file" name="photo">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <small>Status</small>
                            <div class="position-relative mb-3">
                                <select class="form-select form-control-1" name="status">
                                    <option value="-1">Select Status</option>
                                    <option value="1" {{ ($item["status"] == 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ ($item["status"] == 0) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <small>Center Price</small>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-1 ps-3 pe-5 py-2" name="center_price" type="number" placeholder="Center Price" value="{{ number_format($item["center_price"],2,".","") }}" data-current-value="{{ number_format($item["center_price"],2,".","") }}" {{ ($item["type"] == 1) ? 'disabled' : '' }} />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <small>Distributor's Price</small>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-1 ps-3 pe-5 py-2" name="distributors_price" type="number" placeholder="Distributor's Price" value="{{ number_format($item["distributors_price"],2,".","") }}" data-current-value="{{ number_format($item["distributors_price"],2,".","") }}" {{ ($item["type"] == 1) ? 'disabled' : '' }} />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <small>Suggested Retail Price</small>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-1 ps-3 pe-5 py-2" name="suggested_retail_price" type="number" placeholder="Suggested Retail Price" value="{{ number_format($item["suggested_retail_price"],2,".","") }}" data-current-value="{{ number_format($item["suggested_retail_price"],2,".","") }}" {{ ($item["type"] == 1) ? 'disabled' : '' }} />
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <small>Points Value (PV)</small>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-1 ps-3 pe-5 py-2" name="points_value" type="number" placeholder="Points Value (PV)" value="{{ number_format($item["points_value"],2,".","") }}" data-current-value="{{ number_format($item["points_value"],2,".","") }}" {{ ($item["type"] == 1) ? 'disabled' : '' }} />
                            </div>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-6 col-xl-3">
                            <button type="submit" class="btn btn-custom-2 w-100">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</main>

<div class="modal fade" id="add-item-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title">Add Item</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <form id="add-item-form" action="{{ route('admin.items.addItem') }}">
                <div class="modal-body">
                    <div class="form-group">
                        <small for="add-item-name">Item Name</small>
                        <input type="text" class="form-control form-control-1" name="name" placeholder="Item Name" />
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal" style="width:170px">Cancel</button>
                    <button type="submit" class="btn btn-custom-2 px-4 proceed" style="width:170px">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('orders.includes.modalViewOrderItems')
@include('orders.includes.modalViewShipment')

@endsection
