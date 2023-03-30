@extends('layouts.app')

@section('title', 'Conversions')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Conversions</h6>
        <div>
            <button class="btn btn-custom-2 btn-sm px-4" data-bs-toggle="modal" data-bs-target="#modal-convert">Convert</button>
        </div>
    </div>

    <div class="animated fadeIn pt-2 pb-5">
        <ul class="nav nav-tabs mb-4" role="tab-list">
            <li class="nav-item">
                <a class="nav-link {{ ($conversions['type'] == 'gem-to-peso') ? 'active' : '' }}" href="{{ route('conversions.index', 'gem-to-peso') }}" style="{{ ($conversions['type'] == 'gem-to-peso') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Winners Gem to Peso</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($conversions['type'] == 'peso-to-gem') ? 'active' : '' }}" href="{{ route('conversions.index', 'peso-to-gem') }}" style="{{ ($conversions['type'] == 'peso-to-gem') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Peso to Winners Gem</a>
            </li>
        </ul>

        <div class="table-responsive font-size-90">
            @if($conversions['type'] == 'gem-to-peso')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th class="text-center">Date&nbsp;&amp; Time</th>
                        <th class="text-center">Winners Gem</th>
                        <th class="text-center">Peso</th>
                        <th class="text-center">Fee</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conversions['gemToPeso'] as $conversion)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($conversion["created_at"])->isoFormat('llll') }}</td>
                        <td>{{ number_format($conversion["gem"],"2") }} <i class="fas fa-gem gem-change-color"></i></td>
                        <td><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($conversion["peso"], 2) }} </td>
                        <td><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($conversion["fee_in_pesos"], 2) }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif($conversions['type'] == 'peso-to-gem')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th class="text-center">Date&nbsp;&amp; Time</th>
                        <th class="text-center">Peso</th>
                        <th class="text-center">Winners Gem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conversions['pesoToGem'] as $conversion)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($conversion["created_at"])->isoFormat('llll') }}</td>
                        <td><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($conversion["peso"],"2") }}</td>
                        <td>{{ number_format($conversion["gem"],"2") }} <i class="fas fa-gem gem-change-color"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</main>

@include('conversions.includes.modalConvert')
@endsection
