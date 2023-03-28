@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <main class="main">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h6 class="h6 mb-0 text-gray-800">Dashboard</h6>
        </div>

        <div class="animated fadeIn">
            @if(Auth::user()->package_id == 0)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:100px; width:100px">
                            <div class="text-center">
                                <i class="fa fa-gem p-3 font-size-300 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-center mt-4">Join the thriving community of Fairwin Resellers and start earning more today! <br class="d-none d-xl-block">Simply purchase one of our packages to become a part of the team.</h5>
                    <div class="text-center mt-4 mb-3">
                        <a class="btn btn-custom-2 py-3 px-5" href="{{ route('products.index', ['type' => 1]) }}">
                            <i class="fas fa-box"></i>&nbsp;&nbsp;Go to Packages
                        </a>
                    </div>
                </div>
            </div>

            <hr class="mb-4" style="background-color:#444444">
            @endif

            <div class="row align-items-stretch">
                <div class="col-sm-12 col-lg-6 pb-4">
                    <div class="card h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                                <div class="text-center">
                                    <i class="fa fa-gem p-3 font-size-140 text-white"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-value-sm font-size-140" style="color:#0e4d22; line-height:0.9em; margin-top:3px">
                                    <span id="winners-gem-balance">{{ number_format($income['gemBalance'], 2) }}</span>
                                    <i class="fas fa-gem gem-change-color" style="font-size:0.8em"></i>
                                    <span style="font-size:0.7em"> &nbsp;=&nbsp; <i class="fa-solid fa-peso-sign"></i>&nbsp;<span id="winners-gem-balance-in-pesos">{{ number_format($income["gemBalance"] * $winnersGemValue, 2) }}</span></span>
                                </div>
                                <div class="text-uppercase small" style="margin-top:4px">Winners Gem</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2 bg-color-5">
                            <div class="row">
                                <div class="col-6" style="border-right:1px solid #dddddd">
                                    <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="!#" data-toggle="modal" data-bs-target="#modal-gem-purchase">
                                        <span class="small">Buy Winners Gem</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                                <div class="col-6" style="border-left:1px solid #dddddd">
                                    <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="javascript:void(0)" data-toggle="modal" data-bs-target="#modal-convert">
                                        <span class="small">Convert</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6 pb-4">
                    <div class="card h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                                <div class="text-center">
                                    <i class="fa fa-money-bill-alt p-3 font-size-140 text-white"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-value-sm font-size-140" style="color:#0e4d22"><i class="fa-solid fa-peso-sign"></i> <span id="peso-balance">{{ number_format($income["pesoBalance"], 2) }}</span></div>
                                <div class="text-uppercase small">Peso Balance</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2 bg-color-5">
                            <div class="row">
                                <div class="col-6" style="border-right:1px solid #dddddd">
                                    <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="javascript:void(0)" data-toggle="modal" data-bs-target="#modal-withdraw">
                                        <span class="small">Withdraw</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                                <div class="col-6" style="border-left:1px solid #dddddd">
                                    <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="javascript:void(0)" data-toggle="modal" data-bs-target="#modal-pool-share-contribute">
                                        <span class="small">Contribute to Pool Fund</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 pb-4">
                    <div class="card h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                                <div class="text-center">
                                    <i class="fa fa-money-bills p-3 font-size-140 text-white"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-value-sm font-size-140" style="color:#0e4d22"><i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalIncome"], 2) }}</div>
                                <div class="text-uppercase small">Total Earnings</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2 bg-color-5">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('income.index') }}">
                                <span class="small">View Earnings</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 pb-4">
                    <div class="card h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                                <div class="text-center">
                                    <i class="fa fa-money-bill-transfer p-3 font-size-140 text-white"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.1em"><span class="font-size-80">Sent:</span> <span id="winners-gem-sent">{{ number_format($income["totalGemsSent"], 2) }}</span> <i class="fas fa-gem gem-change-color" style="font-size:0.7em"></i></div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.1em; margin-top:-6px"><span class="font-size-80">Received:</span> <span>{{ number_format($income["totalGemsReceived"], 2) }}</span> <i class="fas fa-gem gem-change-color" style="font-size:0.7em"></i></div>
                                <div class="text-uppercase small">Transfers</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2 bg-color-5">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="javascript:void(0)" data-toggle="modal" data-bs-target="#modal-transfer">
                                <span class="small">Transfer</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 pb-4">
                    <div class="card h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                                <div class="text-center">
                                    <i class="fa fa-bags-shopping p-3 font-size-140 text-white"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-value-sm font-size-140" style="color:#0e4d22">{{ number_format(Auth::user()->monthlyPVMaintenance()) }} / {{ number_format(Auth::user()->requiredPVMaintenance()) }} PV</div>
                                <div class="text-uppercase small" style="font-size:0.75em">Monthly PV Maintenance
                                </div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2 bg-color-5">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="javascript:void(0)" data-toggle="modal" data-bs-target="#modal-pv-maintenance-details">
                                <span class="small">View</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 pb-4">
                    <div class="card h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                                <div class="text-center">
                                    <i class="fa fa-trophy p-3 font-size-140 text-white"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-value-sm font-size-130" style="color:#0e4d22; line-height:20px">{{ Auth::user()->packageAndRank() }}</div>
                                <div class="text-uppercase small" style="line-height:24px">Rank Status</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2 bg-color-5">
                            <div class="btn-block d-flex justify-content-between align-items-center">
                                <span
                                    class="small text-color-3">Rank Points: {{ number_format(Auth::user()->totalRankPoints(), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 pb-4">
                    <div class="card h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                                <div class="text-center">
                                    <i class="fa fa-coins p-3 font-size-140 text-white"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-value-sm font-size-140" style="color:#0e4d22"><i class="fa-solid fa-peso-sign"></i> <span id="pool-share-amount">{{ number_format(totalPoolShares(), 2) }}</span></div>
                                <div class="text-uppercase small">Pool Fund</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2 bg-color-5">
                            <div class="btn-block d-flex justify-content-between align-items-center">
                                <span class="small text-color-3">My Shares: 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 pb-4">
                    <div class="card h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
                                <div class="text-center">
                                    <i class="fa fa-users p-3 font-size-140 text-white"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.1em"><span class="font-size-80">Downlines:</span> <span>{{ number_format(Auth::user()->downlineCount()) }}</span></div>
                                <div class="text-value-sm" style="color:#0e4d22; font-size:1.1em; margin-top:-6px"><span class="font-size-80">Referral Code:</span> <span>{{ Auth::user()->referral_code }}</span></div>
                                <div class="text-uppercase small">Network</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2 bg-color-5">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('network.index') }}">
                                <span class="small">View Network</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5" style="background-color:#444444">

            <h5 class="text-center mb-4">Earnings</h5>
            <div class="row align-items-stretch mb-5" id="earnings-container">
                <div class="col-sm-6 col-lg-6 col-xl-3 pb-4">
                    <div class="card text-white bg-color-1 h-100">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">
                                <i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalReferralIncome"], 2) }}</div>
                            <small class="text-uppercase">Direct / Indirect</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalReferralIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-color-1 px-3 py-2">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('income.index') }}">
                                <span class="small">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6 col-xl-3 pb-4">
                    <div class="card text-white bg-color-1 h-100">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">
                                <i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalUnilevelIncome"], 2) }}</div>
                            <small class="text-uppercase">Unilevel</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalUnilevelIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-color-1 px-3 py-2">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('income.index') }}">
                                <span class="small">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3 pb-4">
                    <div class="card text-white bg-color-1 h-100">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">
                                <i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalStairstepIncome"], 2) }}</div>
                            <small class="text-uppercase">Stairstep</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalStairstepIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-color-1 px-3 py-2">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('income.index') }}">
                                <span class="small">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3 pb-4">
                    <div class="card text-white bg-color-1 h-100">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">
                                <i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalPersonalRebateIncome"], 2) }}</div>
                            <small class="text-uppercase">Personal Rebate</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalPersonalRebateIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-color-1 px-3 py-2">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('income.index') }}">
                                <span class="small">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3 pb-4">
                    <div class="card text-white bg-color-1 h-100">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">
                                <i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalInfinityPlusIncome"], 2) }}</div>
                            <small class="text-uppercase">Infinity Plus Bonus</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalInfinityPlusIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-color-1 px-3 py-2">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('income.index') }}">
                                <span class="small">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3 pb-4">
                    <div class="card text-white bg-color-1 h-100">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">
                                <i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalRankIncentiveIncome"], 2) }}</div>
                            <small class="text-uppercase">Rank Incentive</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalRankIncentiveIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-color-1 px-3 py-2">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('income.index') }}">
                                <span class="small">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-3 pb-4">
                    <div class="card text-white bg-color-1 h-100">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">
                                <i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalPoolShareIncome"], 2) }}</div>
                            <small class="text-uppercase">Pool Share Bonus</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalPoolShareIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-color-1 px-3 py-2">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="{{ route('income.index') }}">
                                <span class="small">View More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3 pb-4">
                    <div class="card text-white bg-color-1 h-100">
                        <div class="card-body pt-3">
                            <div class="text-value" style="font-size:1.6em">
                                <i class="fa-solid fa-peso-sign"></i> {{ number_format($income["totalRoyaltyBonusIncome"], 2) }}</div>
                            <small class="text-uppercase">Binary Program</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{ ($income["totalIncome"] > 0) ? ($income["totalRoyaltyBonusIncome"] / $income["totalIncome"]) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-color-1 px-3 py-2">
                            <a class="btn-block d-flex justify-content-between align-items-center text-decoration-none text-color-3" href="https://8fairwin8tradingcorp.com/login">
                                <span class="large">ACCESS</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('products.includes.modalGemPurchase')
@endsection
