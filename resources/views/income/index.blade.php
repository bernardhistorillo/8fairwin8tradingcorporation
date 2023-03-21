@extends('layouts.app')

@section('title', 'Earnings')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="h6 mb-0 text-gray-800">Earnings</h6>
    </div>

    <div class="animated fadeIn pt-2 pb-5">
        <ul class="nav nav-tabs mb-4" role="tab-list">
            <li class="nav-item">
                <a class="nav-link {{ ($income['type'] == 'referral') ? 'active' : '' }}" href="{{ route('income.index', 'referral') }}" style="{{ ($income['type'] == 'referral') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Referral</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($income['type'] == 'unilevel') ? 'active' : '' }}" href="{{ route('income.index', 'unilevel') }}" style="{{ ($income['type'] == 'unilevel') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Unilevel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($income['type'] == 'stairstep') ? 'active' : '' }}" href="{{ route('income.index', 'stairstep') }}" style="{{ ($income['type'] == 'stairstep') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Stairstep</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($income['type'] == 'personalrebate') ? 'active' : '' }}" href="{{ route('income.index', 'personalrebate') }}" style="{{ ($income['type'] == 'personalrebate') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Personal Rebate</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($income['type'] == 'infinityplusbonus') ? 'active' : '' }}" href="{{ route('income.index', 'infinityplusbonus') }}" style="{{ ($income['type'] == 'infinityplusbonus') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Infinity Plus Bonus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($income['type'] == 'rankincentive') ? 'active' : '' }}" href="{{ route('income.index', 'rankincentive') }}" style="{{ ($income['type'] == 'rankincentive') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Rank Incentive</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($income['type'] == 'royaltybonus') ? 'active' : '' }}" href="{{ route('income.index', 'royaltybonus') }}" style="{{ ($income['type'] == 'royaltybonus') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Royalty Bonus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($income['type'] == 'poolsharebonus') ? 'active' : '' }}" href="{{ route('income.index', 'poolsharebonus') }}" style="{{ ($income['type'] == 'poolsharebonus') ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Pool Share Bonus</a>
            </li>
        </ul>

        <div class="table-responsive">
            <h6 class="text-center my-5 loading-text">Loading...</h6>
            @if($income['type'] == 'referral')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th class="text-center">Date&nbsp;&amp; Time</th>
                        <th class="text-center">Downline</th>
                        <th class="text-center">Level</th>
                        <th class="text-center">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($income['referral'] as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                        <td>{{ fullName($item) }}</td>
                        <td>{{ $item['level'] }}</td>
                        <td>&#8369;&nbsp;{{ number_format($item["amount"], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif($income['type'] == 'unilevel')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                    <tr>
                        <th class="text-center">Date&nbsp;&amp; Time</th>
                        <th class="text-center">Downline</th>
                        <th class="text-center">Level</th>
                        <th class="text-center">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($income['unilevel'] as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                        <td>{{ fullName($item) }}</td>
                        <td>{{ $item['level'] }}</td>
                        <td>&#8369;&nbsp;{{ number_format($item["amount"], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif($income['type'] == 'stairstep')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                <tr>
                    <th class="text-center">Date&nbsp;&amp; Time</th>
                    <th class="text-center">Downline</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($income['stairstep'] as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                    <td>{{ fullName($item) }}</td>
                    <td>{{ $item['level'] }}</td>
                    <td>&#8369;&nbsp;{{ number_format($item["amount"], 2) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @elseif($income['type'] == 'personalrebate')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                <tr>
                    <th class="text-center">Date&nbsp;&amp; Time</th>
                    <th class="text-center">Order Reference</th>
                    <th class="text-center">Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($income['personalRebate'] as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                    <td>{{ $item['reference'] }}</td>
                    <td>&#8369;&nbsp;{{ number_format($item["amount"], 2) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @elseif($income['type'] == 'infinityplusbonus')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                <tr>
                    <th class="text-center">Date&nbsp;&amp; Time</th>
                    <th class="text-center">Downline</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($income['infinityPlusBonus'] as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                    <td>{{ fullName($item) }}</td>
                    <td>{{ $item['level'] }}</td>
                    <td>&#8369;&nbsp;{{ number_format($item["amount"], 2) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @elseif($income['type'] == 'rankincentive')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                <tr>
                    <th class="text-center">Date&nbsp;&amp; Time</th>
                    <th class="text-center">Rank</th>
                    <th class="text-center">Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($income['rankIncentive'] as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                    <td>{{ $ranks[$rank_incentives_income["rank"]] }}</td>
                    <td>&#8369;&nbsp;{{ number_format($item["amount"], 2) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @elseif($income['type'] == 'royaltybonus')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                <tr>
                    <th class="text-center">Date&nbsp;&amp; Time</th>
                    <th class="text-center">Downline</th>
                    <th class="text-center">Generation</th>
                    <th class="text-center">Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($income['royaltyBonus'] as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                    <td>{{ fullName($item) }}</td>
                    <td>{{ $item["generation"] . ($item["generation"] == 1) ? "st" : (($item["generation"] == 2) ? "nd" : (($item["generation"] == 3) ? "rd" : "th")) }}</td>
                    <td>&#8369;&nbsp;{{ number_format($item["amount"], 2) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @elseif($income['type'] == 'poolsharebonus')
            <table class="table table-bordered data-table" style="display:none">
                <thead>
                <tr>
                    <th class="text-center">Date&nbsp;&amp; Time</th>
                    <th class="text-center">Shares</th>
                    <th class="text-center">Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($income['poolShare'] as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->isoFormat('llll') }}</td>
                    <td>{{ $item['shares'] }}</td>
                    <td>&#8369;&nbsp;{{ number_format($item["amount"], 2) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</main>
@endsection
