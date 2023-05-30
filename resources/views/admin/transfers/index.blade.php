@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Transfers</h6>
    </div>

    <div class="animated fadeIn">
        <div class="table-responsive font-size-90 mt-1 mb-5">
            <p class="text-center py-5 my-5 loading-text">Loading...</p>
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th>Date &amp; Time</th>
                        <th>Sender</th>
                        <th>Recipient</th>
                        <th>Winners Gem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transfers as $i => $transfer)
                    <tr>
                        <td>{{ formatDate($transfer["created_at"]) }}</td>
                        <td>{{ $transfer["sender_firstname"] . ' ' . $transfer["sender_lastname"] }}</td>
                        <td>{{ $transfer["receiver_firstname"] . ' ' . $transfer["receiver_lastname"] }}</td>
                        <td class="text-end">{{ number_format($transfer["amount"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
