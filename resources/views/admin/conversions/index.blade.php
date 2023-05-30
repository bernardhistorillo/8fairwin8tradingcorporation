@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Users</h6>
    </div>

    <div class="animated fadeIn">
        <ul class="nav nav-tabs mb-4" role="tab-list">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#peso-to-gem" role="tab" aria-controls="peso-to-gem" aria-selected="peso-to-gem">Peso to Winners Gem</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#gem-to-peso" role="tab" aria-controls="gem-to-peso" aria-selected="gem-to-peso">Winners Gem to Peso</a>
            </li>
        </ul>

        <div class="mb-5">
            <div class="tab-content pt-2">
                <div class="tab-pane fade in show active" id="peso-to-gem" role="tabpanel" aria-labelledby="peso-to-gem-tab">
                    <div class="table-responsive font-size-90 mt-1">
                        <p class="text-center py-5 my-5 loading-text">Loading...</p>
                        <table class="table table-bordered data-table" style="display:none">
                            <thead>
                                <tr>
                                    <th>Date &amp; Time</th>
                                    <th>Account</th>
                                    <th>Peso</th>
                                    <th>Winners Gem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($conversions as $conversion)
                                    @if($conversion["type"] == 2)
                                <tr>
                                    <td>{{ formatDate($conversion["created_at"]) }}</td>
                                    <td>{{ fullName($conversion) }}</td>
                                    <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($conversion["peso"],2) }}</td>
                                    <td class="text-end">{{ number_format($conversion["gem"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="gem-to-peso" role="tabpanel" aria-labelledby="gem-to-peso-tab">
                    <div class="table-responsive font-size-90 mt-4">
                        <p class="text-center py-5 my-5 loading-text">Loading...</p>
                        <table class="table table-bordered data-table" style="display:none">
                            <thead>
                                <tr style="background-color:#f9f9f9">
                                    <th>Date &amp; Time</th>
                                    <th>Account</th>
                                    <th>Winners Gem</th>
                                    <th>Peso</th>
                                    <th>Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($conversions as $conversion)
                                    @if($conversion["type"] == 1)
                                <tr>
                                    <td>{{ formatDate($conversion["created_at"]) }}</td>
                                    <td>{{ fullName($conversion) }}</td>
                                    <td class="text-end">{{ number_format($conversion["gem"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                                    <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($conversion["peso"],2) }}</td>
                                    <td class="text-end"><i class="fa-solid fa-peso-sign"></i>&nbsp;{{ number_format($conversion["fee_in_pesos"],2) }}</td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
