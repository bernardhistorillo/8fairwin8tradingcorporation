@extends('layouts.app')

@section('title', 'Admin Orders')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Income Distribution</h6>
    </div>

    <div class="animated fadeIn">
        @foreach($orders as $i => $order)
        <div class="card border-radius-0 mb-5">
            <div class="card-body">
                <div class="table-responsive font-size-90">
                    <table class="table table-bordered">
                        <tr class="bg-color-2 text-white">
                            <th>Date &amp; Time Placed</th>
                            <th>Type</th>
                            <th>Reference</th>
                            <th>Account</th>
                            <th>Price</th>
                            <th>Points</th>
                            <th>Distributed</th>
                        </tr>
                        <tr>
                            <td>{{ formatDate($order["created_at"]) }}</td>
                            <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                            <td>{{ $order["reference"] }}</td>
                            <td>{{ fullName($order) }}</td>
                            <td class="text-end">{{ number_format($order["price"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                            <td class="text-end">{{ number_format($order["points_value"],2) }} PV</td>
                            <td class="text-end">{{ number_format($order["distributed"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                        </tr>
                    </table>
                </div>

                <div class="accordion" id="accordion-{{ $i }}">
                    @if($order['type'] == 1)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $i }}-1" aria-expanded="false" aria-controls="collapse-{{ $i }}-1">
                                <span class="font-size-90">Referral Income&nbsp;&nbsp;|&nbsp;&nbsp;{{ number_format($order['referralIncomesTotal'],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></span>
                            </button>
                        </h2>
                        <div id="collapse-{{ $i }}-1" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $i }}">
                            <div class="accordion-body">
                                <div class="table-responsive font-size-90">
                                    <table class="table table-bordered mb-0">
                                        <tr>
                                            <th>Level</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                        </tr>
                                        @foreach($order['referralIncomes'] as $referralIncome)
                                        <tr>
                                            <td>{{ $referralIncome['level'] }}</td>
                                            <td>{{ fullName($referralIncome) }}</td>
                                            <td class="text-end">{{ number_format($referralIncome["amount"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $i }}-2" aria-expanded="false" aria-controls="collapse-{{ $i }}-2">
                                <span class="font-size-90">Infinity Plus Bonus&nbsp;&nbsp;|&nbsp;&nbsp;{{ number_format($order['infinityPlusIncomesTotal'],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></span>
                            </button>
                        </h2>
                        <div id="collapse-{{ $i }}-2" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $i }}">
                            <div class="accordion-body">
                                <div class="table-responsive font-size-90">
                                    <table class="table table-bordered mb-0">
                                        <tr>
                                            <th>Level</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                        </tr>
                                        @foreach($order['infinityPlusIncomes'] as $infinityPlusIncome)
                                        <tr>
                                            <td>{{ $infinityPlusIncome['level'] }}</td>
                                            <td>{{ fullName($infinityPlusIncome) }}</td>
                                            <td class="text-end">{{ number_format($infinityPlusIncome["amount"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $i }}-1" aria-expanded="false" aria-controls="collapse-{{ $i }}-1">
                                <span class="font-size-90">Unilevel Income&nbsp;&nbsp;|&nbsp;&nbsp;{{ number_format($order['unilevelIncomesTotal'],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></span>
                            </button>
                        </h2>
                        <div id="collapse-{{ $i }}-1" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $i }}">
                            <div class="accordion-body">
                                <div class="table-responsive font-size-90">
                                    <table class="table table-bordered mb-0">
                                        <tr>
                                            <th>Level</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                            <th>Received</th>
                                        </tr>
                                        @foreach($order['unilevelIncomes'] as $unilevelIncome)
                                        <tr>
                                            <td>{{ $unilevelIncome['level'] }}</td>
                                            <td>{{ fullName($unilevelIncome) }}</td>
                                            <td class="text-end">{{ number_format($unilevelIncome["amount"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                                            <td class="text-center {{ $unilevelIncome['received'] == 1 ? 'bg-color-2 text-white' : 'bg-color-1' }}">{{ $unilevelIncome['received'] == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $i }}-2" aria-expanded="false" aria-controls="collapse-{{ $i }}-2">
                                <span class="font-size-90">Stairstep Income&nbsp;&nbsp;|&nbsp;&nbsp;{{ number_format($order['stairstepIncomesTotal'],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></span>
                            </button>
                        </h2>
                        <div id="collapse-{{ $i }}-2" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $i }}">
                            <div class="accordion-body">
                                <div class="table-responsive font-size-90">
                                    <table class="table table-bordered mb-0">
                                        <tr>
                                            <th>Level</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                            <th>Received</th>
                                        </tr>
                                        @foreach($order['stairstepIncomes'] as $stairstepIncome)
                                        <tr>
                                            <td>{{ $stairstepIncome['level'] }}</td>
                                            <td>{{ fullName($stairstepIncome) }}</td>
                                            <td class="text-end">{{ number_format($stairstepIncome["amount"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                                            <td class="text-center {{ $stairstepIncome['received'] == 1 ? 'bg-color-2 text-white' : 'bg-color-1' }}">{{ $stairstepIncome['received'] == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse">
                                <span class="font-size-90">Personal Rebate&nbsp;&nbsp;|&nbsp;&nbsp;{{ number_format($order['personalRebateIncome']['amount'],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></span>
                            </button>
                        </h2>
                    </div>
                    @endif

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse">
                                <span class="font-size-90">Pool Share&nbsp;&nbsp;|&nbsp;&nbsp;{{ number_format($order['pool_share'],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></span>
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="mb-5">
            {{ $orders->links('admin.incomeDistribution.includes.pagination') }}
        </div>
    </div>
</main>

@include('orders.includes.modalViewOrderItems')
@include('orders.includes.modalViewShipment')

@endsection
