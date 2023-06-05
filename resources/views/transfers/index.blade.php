@extends('layouts.app')

@section('title', 'Transfers')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Transfers</h6>
        <div>
            <button class="btn btn-custom-2 btn-sm px-4" data-bs-toggle="modal" data-bs-target="#modal-transfer">Transfer</button>
        </div>
    </div>

    <div class="animated fadeIn pt-2 pb-5">
        <ul class="nav nav-tabs mb-4" role="tab-list">
            <li class="nav-item">
                <a class="nav-link {{ ($transfers['type'] == 'received') ? 'active' : '' }}" href="{{ route('transfers.index', 'received') }}" style="{{ ($transfers['type'] == 'received') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Received</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($transfers['type'] == 'sent') ? 'active' : '' }}" href="{{ route('transfers.index', 'sent') }}" style="{{ ($transfers['type'] == 'sent') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Sent</a>
            </li>
        </ul>

        <div class="table-responsive font-size-90">
            @if($transfers['type'] == 'received')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th>Date&nbsp;&amp; Time</th>
                        <th>Sender</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transfers['received'] as $transfersReceived)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($transfersReceived["date_time"])->isoFormat('llll') }}</td>
                        <td>{{ fullName($transfersReceived) }}</td>
                        <td class="text-end">{{ number_format($transfersReceived["amount"],2) }} <i class="fas fa-gem gem-change-color"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif($transfers['type'] == 'sent')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th>Date&nbsp;&amp; Time</th>
                        <th>Recipient</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transfers['sent'] as $transfersSent)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($transfersSent["date_time"])->isoFormat('llll') }}</td>
                        <td>{{ fullName($transfersSent) }}</td>
                        <td class="text-end">{{ number_format($transfersSent["amount"],2) }} <i class="fas fa-gem gem-change-color"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</main>

@include('transfers.includes.modalTransfer')
@endsection
