@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Genealogy</h6>
    </div>

    <div class="animated fadeIn">
        <input type="hidden" name="get-genealogy-route" value="{{ route('network.getGenealogy') }}" />

        <ul class="nav nav-tabs mb-3" role="tab-list">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#graphical" role="tab" aria-controls="graphical" aria-selected="true">Graphical</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#table" role="tab" aria-controls="table" aria-selected="false">Table</a>
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
                    <p class="text-center my-5 py-5">Loading...</p>
                </div>
            </div>

            <div class="tab-pane fade" id="table" role="tabpanel" aria-labelledby="table-tab">
                <div class="table-responsive genealogy-table-container font-size-90"></div>
            </div>
        </div>

        <div class="d-none" id="has-network" data-value="1"></div>
    </div>
</main>
@endsection
