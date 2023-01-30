@extends('layouts.app')

@section('title', 'Income')

@section('content')
<main class="main">
    <div class="d-flex">
        <ol class="breadcrumb flex-fill">
            <li class="breadcrumb-item active">Earnings</li>
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
                    <ul class="nav nav-tabs mb-3" role="tab-list">
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
                                    <th>Date&nbsp;&amp; Time</th>
                                    <th>Downline</th>
                                    <th>Level</th>
                                    <th>Amount</th>
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
                                    <th>Date&nbsp;&amp; Time</th>
                                    <th>Downline</th>
                                    <th>Level</th>
                                    <th>Amount</th>
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
                                <th>Date&nbsp;&amp; Time</th>
                                <th>Downline</th>
                                <th>Level</th>
                                <th>Amount</th>
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
                                <th>Date&nbsp;&amp; Time</th>
                                <th>Order Reference</th>
                                <th>Amount</th>
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
                                <th>Date&nbsp;&amp; Time</th>
                                <th>Downline</th>
                                <th>Level</th>
                                <th>Amount</th>
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
                                <th>Date&nbsp;&amp; Time</th>
                                <th>Rank</th>
                                <th>Amount</th>
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
                                <th>Date&nbsp;&amp; Time</th>
                                <th>Downline</th>
                                <th>Generation</th>
                                <th>Amount</th>
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
                                <th>Date&nbsp;&amp; Time</th>
                                <th>Shares</th>
                                <th>Amount</th>
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
            </div>
        </div>
    </div>
</main>
@endsection
