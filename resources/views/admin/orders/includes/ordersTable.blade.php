<div class="tab-content pt-2">
    <div class="tab-pane fade in show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
        <input type="hidden" id="mark-order-as-complete-route" value="{{ route('orders.markOrderAsComplete') }}" />

        <div class="table-responsive font-size-90 mt-1">
            <p class="text-center py-5 my-5 loading-text">Loading...</p>
            <table class="table table-bordered data-table d-none">
                <thead>
                    <tr>
                        <th></th>
                        <th>Date &amp; Time Placed</th>
                        <th>Type</th>
                        <th>Reference</th>
                        <th>Account</th>
                        <th>Price</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @if(!$order["date_time_completed"])
                    <tr>
                        <td class="pt-2">
                            <div class="d-flex justify-content-center align-items-center flex-wrap flex-xl-nowrap">
                                <div class="me-1 mb-1 mb-xl-0">
                                    <button class="btn btn-custom-2 btn-sm font-size-90 view-items" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}">Items</button>
                                </div>
                                <div class="me-xl-1 mb-1 mb-xl-0">
                                    <button class="btn btn-custom-2 btn-sm font-size-90 view-shipment" data-reference="{{ $order["reference"] }}" data-full-name="{{ $order["full_name"] }}" data-contact-number="{{ $order["contact_number"] }}" data-barangay="{{ $order["barangay"] }}" data-city="{{ $order["city"] }}" data-province="{{ $order["province"] }}" data-zip-code="{{ $order["zip_code"] }}">Shipment</button>
                                </div>
                                @if($order["terminal_user_id"] == 0)
                                <div class="">
                                    <button class="btn btn-custom-2 btn-sm font-size-90 mark-order-as-complete-confirm" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}" data-from="admin">Mark&nbsp;as&nbsp;Complete</button>
                                </div>
                                @else
                                <div class="">
                                    <button class="btn btn-custom-2 btn-sm font-size-90 show-stockist" data-name="{{ fullName($stockists[$order["terminal_user_id"]]) }}" data-rank="{{ $stockists[$order["terminal_user_id"]]["rank"] }}" data-email-address="{{ $stockists[$order["terminal_user_id"]]["email"] }}">Stockist</button>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>{{ formatDate($order["created_at"]) }}</td>
                        <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                        <td>{{ $order["reference"] }}</td>
                        <td>
                            <div>{{ fullName($order) }}</div>
                            @if($order["order_stockist"] > 0 || $order["account_stockist"] > 0)
                            <div style="font-style:italic; font-size:0.9em">(As {{ $stockistLabels[$order["order_stockist"]] }})</div>
                            @endif
                        </td>
                        <td class="text-end">{{ number_format($order["price"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                        <td class="text-end">{{ number_format($order["points_value"],2) }} PV</td>
                    </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
        <div class="table-responsive font-size-90 mt-4">
            <p class="text-center py-5 my-5 loading-text">Loading...</p>
            <table class="table table-bordered data-table d-none">
                <thead>
                    <tr>
                        <th></th>
                        <th>Date &amp; Time Placed</th>
                        <th>Date &amp; Completed</th>
                        <th>Type</th>
                        <th>Reference</th>
                        <th>Account</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @if($order["date_time_completed"])
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center align-items-center flex-wrap flex-xl-nowrap">
                                <div class="me-1 mb-1 mb-xl-0">
                                    <button class="btn btn-custom-2 btn-sm font-size-90 view-items" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}">Items</button>
                                </div>
                                <div class="me-1 mb-1 mb-xl-0">
                                    <button class="btn btn-custom-2 btn-sm font-size-90 view-shipment" data-reference="{{ $order["reference"] }}" data-full-name="{{ $order["full_name"] }}" data-contact-number="{{ $order["contact_number"] }}" data-barangay="{{ $order["barangay"] }}" data-city="{{ $order["city"] }}" data-province="{{ $order["province"] }}" data-zip-code="{{ $order["zip_code"] }}">Shipment</button>
                                </div>
                                @if($order["terminal_user_id"] != 0)
                                <div class="me-1 mb-1 mb-xl-0">
                                    <button class="btn btn-custom-2 btn-sm font-size-90 show-stockist" data-name="{{ fullName($stockists[$order["terminal_user_id"]]) }}" data-rank="{{ $stockists[$order["terminal_user_id"]]["rank"] }}" data-email-address="{{ $stockists[$order["terminal_user_id"]]["email"] }}">Stockist</button>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>{{ formatDate($order["created_at"]) }}</td>
                        <td>{{ formatDate($order["date_time_completed"]) }}</td>
                        <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                        <td>{{ $order["reference"] }}</td>
                        <td>
                            <div>{{ fullName($order) }}</div>
                            @if($order["order_stockist"] > 0 || $order["account_stockist"] > 0)
                            <div style="font-style:italic; font-size:0.9em">(As {{ $stockistLabels[$order["order_stockist"]] }})</div>
                            @endif
                        </td>
                        <td class="text-end">{{ number_format($order["price"],2) }} <i class="fa-solid fa-gem gem-change-color font-size-90"></i></td>
                    </tr>
                         @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
