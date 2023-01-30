@extends('layouts.app')

@section('title', 'Log In')

@section('content')
<main class="main">
    <div class="d-flex">
        <ol class="breadcrumb flex-fill">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <ol class="breadcrumb text-white" style="background-color:#2f353a">
            <li class="breadcrumb-item">
                <i class="fas fa-gem"></i> <span class="px-1">:</span> &#8369;&nbsp;{{ number_format($winnersGemValue, 2) }}
            </li>
        </ol>
    </div>
    <div class="container-fluid pb-5">
        <div class="animated fadeIn">
            @if(Auth::user()->package_id == 0)
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div style="display:inline-block; border-radius:50%; border:4px solid #0e4d22; width:100px; height:100px; padding-top:17px">
                            <i class="fas fa-exclamation" style="color:#0e4d22; font-size:4em"></i>
                        </div>
                    </div>
                    <h5 class="text-center mt-4">Be a Fairwin Reseller! to get the most out of this program. You can be one by purchasing one of our packages.</h5>
                    <div class="text-center mt-4 mb-3"><a class="btn btn-success" href="{{ route('products.index', ['type' => 1]) }}" style="background-color:#0e4d22"><i class="fas fa-box"></i>&nbsp;&nbsp;Go to Packages</a></div>
                </div>
            </div>

            <hr class="mb-4" style="background-color:#444444">
            @endif

            <div class="row align-items-center">
                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <i class="fas fa-gem p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.5em; line-height:0.9em; margin-top:3px">
                                    <span id="winners-gem-balance">{{ number_format($income['gemBalance'], 2) }}</span>
                                    <i class="fas fa-gem" style="font-size:0.8em"></i>
                                    <span style="font-size:0.7em"> &nbsp;=&nbsp; &#8369;&nbsp;<span id="winners-gem-balance-in-pesos">{{ number_format($income["gemBalance"] * $winnersGemValue, 2) }}</span></span>
                                </div>
                                <div class="text-muted text-uppercase font-weight-bold small" style="margin-top:4px">Winners Gem</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <div class="row">
                                <div class="col-6" style="border-right:1px solid #dddddd">
                                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="!#" data-toggle="modal" data-target="#modal-gem-purchase">
                                        <span class="small font-weight-bold">Buy Winners Gem</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                                <div class="col-6" style="border-left:1px solid #dddddd">
                                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="javascript:void(0)" data-toggle="modal" data-target="#modal-convert">
                                        <span class="small font-weight-bold">Convert</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <i class="fa fa-money-bill-alt p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.5em">&#8369; <span id="peso-balance">{{ number_format($income["pesoBalance"], 2) }}</span></div>
                                <div class="text-muted text-uppercase font-weight-bold small">Peso Balance</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <div class="row">
                                <div class="col-6" style="border-right:1px solid #dddddd">
                                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="javascript:void(0)" data-toggle="modal" data-target="#modal-withdraw">
                                        <span class="small font-weight-bold">Withdraw</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                                <div class="col-6" style="border-left:1px solid #dddddd">
                                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="javascript:void(0)" data-toggle="modal" data-target="#modal-pool-share-contribute">
                                        <span class="small font-weight-bold">Contribute to Pool Fund</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <i class="fa fa-money-bill-alt p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.5em">&#8369; {{ number_format($income["totalIncome"], 2) }}</div>
                                <div class="text-muted text-uppercase font-weight-bold small">Total Earnings</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('income.index') }}">
                                <span class="small font-weight-bold">View Earnings</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <i class="fa fa-gem p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.1em"><span style="font-size:0.8em">Sent:</span> <span id="winners-gem-sent">{{ number_format($income["totalGemsSent"], 2) }}</span> <i class="fas fa-gem" style="font-size:0.7em"></i></div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.1em; margin-top:-6px"><span style="font-size:0.8em">Received:</span> {{ number_format($income["totalGemsReceived"], 2) }} <i class="fas fa-gem" style="font-size:0.7em"></i></div>
                                <div class="text-muted text-uppercase font-weight-bold small">Transfers</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="javascript:void(0)" data-toggle="modal" data-target="#modal-transfer">
                                <span class="small font-weight-bold">Transfer</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <i class="fa fa-money-bill-alt p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.5em">{{ number_format(Auth::user()->monthlyPVMaintenance()) }} / {{ number_format(Auth::user()->requiredPVMaintenance()) }}</div>
                                <div class="text-muted text-uppercase font-weight-bold small" style="font-size:0.75em">Monthly PV Maintenance</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="javascript:void(0)" data-toggle="modal" data-target="#modal-pv-maintenance-details">
                                <span class="small font-weight-bold">View</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <i class="fa fa-trophy p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.3em; line-height:20px">{{ Auth::user()->packageAndRank() }}</div>
                                <div class="text-muted text-uppercase font-weight-bold small" style="line-height:24px">Rank Status</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <div class="btn-block text-muted d-flex justify-content-between align-items-center">
                                <span class="small font-weight-bold">Rank Points: {{ number_format(Auth::user()->totalRankPoints(), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <i class="fa fa-money-bill-wave p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.5em">&#8369; <span id="pool-share-amount">{{ number_format(totalPoolShares(), 2) }}</span></div>
                                <div class="text-muted text-uppercase font-weight-bold small">Pool Fund</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <div class="btn-block text-muted d-flex justify-content-between align-items-center">
                                <span class="small font-weight-bold">My Shares: 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <i class="fa fa-users p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.1em"><span style="font-size:0.8em">Downlines:</span> {{ number_format(Auth::user()->downlineCount())  }}</div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.1em; margin-top:-6px"><span style="font-size:0.8em">Referral Code:</span> {{ Auth::user()->referral_code  }}</div>
                                <div class="text-muted text-uppercase font-weight-bold small">Network</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('network.index') }}">
                                <span class="small font-weight-bold">View Network</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mb-4" style="background-color:#444444">

            <h5 class="text-center mb-4">Earnings</h5>
            <div class="row">
                <div class="col-sm-6 col-lg-6 col-xl-3">
                    <div class="card text-white bg-success">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">&#8369; {{ number_format($income["totalReferralIncome"], 2) }}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Direct / Indirect</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalReferralIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-success px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('income.index') }}">
                                <span class="small font-weight-bold">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6 col-xl-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">&#8369; {{ number_format($income["totalUnilevelIncome"], 2) }}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Unilevel</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalUnilevelIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-warning px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('income.index') }}">
                                <span class="small font-weight-bold">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">&#8369; {{ number_format($income["totalStairstepIncome"], 2) }}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Stairstep</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalStairstepIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-primary px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('income.index') }}">
                                <span class="small font-weight-bold">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">&#8369; {{ number_format($income["totalPersonalRebateIncome"], 2) }}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Personal Rebate</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalPersonalRebateIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-danger px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('income.index') }}">
                                <span class="small font-weight-bold">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card text-white bg-indigo">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">&#8369; {{ number_format($income["totalInfinityPlusIncome"], 2) }}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Infinity Plus Bonus</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalInfinityPlusIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-indigo px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('income.index') }}">
                                <span class="small font-weight-bold">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card text-white bg-cyan">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">&#8369; {{ number_format($income["totalRankIncentiveIncome"], 2) }}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Rank Incentive</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalRankIncentiveIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-cyan px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('income.index') }}">
                                <span class="small font-weight-bold">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card text-white bg-gray">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">&#8369; {{ number_format($income["totalPoolShareIncome"], 2) }}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Pool Share Bonus</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalPoolShareIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-gray px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('income.index') }}">
                                <span class="small font-weight-bold">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card text-white bg-purple">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">&#8369; {{ number_format($income["totalRoyaltyBonusIncome"], 2) }}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Binary Program</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalRoyaltyBonusIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-purple px-3 py-2">
                            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="https://8fairwin8tradingcorp.com/login">
                                <span class="large font-weight-bold">ACCESS</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
