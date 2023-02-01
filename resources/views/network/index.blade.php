@extends('layouts.app')

@section('title', 'Income')

@section('content')
<main class="main">
    <div class="d-flex">
        <ol class="breadcrumb flex-fill">
            <li class="breadcrumb-item active">Network</li>
        </ol>

        <ol class="breadcrumb text-white" style="background-color:#2f353a">
            <li class="breadcrumb-item">
                <i class="fas fa-gem"></i> <span class="px-1">:</span> &#8369;&nbsp;{{ number_format(winnersGemValue(), 2) }}
            </li>
        </ol>
    </div>

    <div class="container-fluid pb-5">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->package_id != 0)
                    <input type="hidden" name="get-genealogy-route" value="{{ route('network.getGenealogy') }}" />

                    <ul class="nav nav-tabs mb-3" role="tab-list">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#graphical" role="tab" aria-controls="graphical" aria-selected="true">Graphical</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#table" role="tab" aria-controls="table" aria-selected="false">Table</a>
                        </li>
                    </ul>

                    <div class="tab-content pt-2">
                        <div class="tab-pane fade in show active" id="graphical" role="tabpanel" aria-labelledby="graphical-tab">
                            <ol class="breadcrumb mt-2 uplines-container"></ol>

                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="input-form">
                                        <label class="active" for="number-of-levels-to-be-shown">No. of Levels to be Shown</label>
                                        <input id="number-of-levels-to-be-shown" type="number" class="form-control" min="1" value="1" style="text-align:center" />
                                    </div>
                                </div>
                            </div>

                            <div id="chart" style="overflow-x:auto; width:100%; border:1px solid #dddddd">
                                <h5 class="text-center my-5 py-5">Loading...</h5>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="table" role="tabpanel" aria-labelledby="table-tab">
                            <div class="table-responsive genealogy-table-container"></div>
                        </div>
                    </div>

                    <div class="d-none" id="has-network" data-value="1"></div>
                    @else
                    <h6 class="text-center mt-5">You must first be a Fairwin Dealer to have a network. You can be one by purchasing one of our packages.</h6>
                    <div class="text-center mt-3 mb-5"><a class="btn btn-success" href="{{ route('products.index', ['type' => 1]) }}" style="background-color:#0e4d22">Go to Packages</a></div>
                    <div class="d-none" id="has-network" data-value="0"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
