@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Dashboard</h6>
    </div>

    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                            <div class="text-center">
                                <i class="fa fa-gem p-3 font-size-140 text-white"></i>
                            </div>
                        </div>

                        <div>
                            <div class="text-value-sm font-size-140" style="color:#0e4d22"><span class="winners-gem-value">{{ number_format(winnersGemValue(), 2) }}</span> <i class="fa-solid fa-gem font-size-90 gem-change-color"></i></div>
                            <div class="text-uppercase small">Winners Gem Value</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2 bg-color-5">
                        <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="#" data-bs-toggle="modal" data-bs-target="#modal-winners-gem-value">
                            <span class="small">Update Value</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modal-winners-gem-value" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title">Update Winners Gem Value</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <form id="update-winners-gem-value-form" action="{{ route('admin.winnersgem.updateValue') }}">
                <div class="modal-body">
                    <div class="position-relative mb-0">
                        <input class="form-control form-control-1 px-5 py-2 text-center" name="winners_gem_value" type="text" placeholder="Winners Gem Value" min="0" value="{{ number_format(winnersGemValue(), 2, '.', '') }}" />
                        <div class="position-absolute" style="right:20px; top:9px">
                            <i class="fas fa-peso-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal" style="width:170px">Cancel</button>
                    <button type="submit" class="btn btn-custom-2 px-4" id="update-proof-of-payment-confirm" style="width:170px">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
