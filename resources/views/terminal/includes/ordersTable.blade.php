<div class="tab-pane fade in show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
    <div class="table-responsive mt-1">
        <h6 class="text-center py-5 my-5 loading-text">Loading...</h6>
        <table class="table table-bordered data-table font-size-90" style="display:none">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center">Date&nbsp;&amp; Time Placed</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Reference</th>
                    <th class="text-center">Account</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @if(!$order["date_time_completed"])
                <tr>
                    <td class="text-center pt-2">
                        <button class="btn btn-custom-2 btn-sm mt-1 font-size-90 view-items" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}" style="width:83px">Items</button>
                        <button class="btn btn-custom-2 btn-sm mt-1 font-size-90 view-shipment" data-reference="{{ $order["reference"] }}" data-full-name="{{ $order["full_name"] }}" data-contact-number="{{ $order["contact_number"] }}" data-barangay="{{ $order["barangay"] }}" data-city="{{ $order["city"] }}" data-province="{{ $order["province"] }}" data-zip-code="{{ $order["zip_code"] }}" style="width:82px">Shipment</button>
                        <button class="btn btn-custom-2 btn-sm mt-1 font-size-90 mark-order-as-complete-confirm" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}" data-from="terminal" style="width:168px">Mark as Complete</button>
                    </td>
                    <td>{{ formatDate($order["created_at"]) }}</td>
                    <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                    <td>{{ $order["reference"] }}</td>
                    <td>{{ fullName($order) }}</td>
                    <td>{{ number_format($order["price"], 2) }} <i class="fas fa-gem gem-change-color"></i></td>
                    <td>{{ number_format($order["points_value"], 2) }} PV</td>
                </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="approved-tab">
    <div class="table-responsive mt-4">
        <h6 class="text-center py-5 my-5 loading-text">Loading...</h6>
        <table class="table table-bordered data-table font-size-90" style="display:none">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center">Date&nbsp;&amp; Time Placed</th>
                    <th class="text-center">Date&nbsp;&amp; Completed</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Reference</th>
                    <th class="text-center">Account</th>
                    <th class="text-center">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @if($order["date_time_completed"])
                <tr>
                    <td class="text-center">
                        <button class="btn btn-custom-2 btn-sm font-size-90 mt-1 view-items" value="{{ $order["id"] }}" data-reference="{{ $order["reference"] }}" style="width:82px">Items</button>
                        <button class="btn btn-custom-2 btn-sm font-size-90 mt-1 view-shipment" data-reference="{{ $order["reference"] }}" data-full-name="{{ $order["full_name"] }}" data-contact-number="{{ $order["contact_number"] }}" data-barangay="{{ $order["barangay"] }}" data-city="{{ $order["city"] }}" data-province="{{ $order["province"] }}" data-zip-code="{{ $order["zip_code"] }}" style="width:82px">Shipment</button>
                    </td>
                    <td>{{ formatDate($order["created_at"]) }}</td>
                    <td>{{ formatDate($order["date_time_completed"]) }}</td>
                    <td>{{ ($order["type"] == 1) ? "Package" : "Product" }}</td>
                    <td>{{ $order["reference"] }}</td>
                    <td>{{ fullName($order) }}</td>
                    <td>{{ number_format($order["price"], 2) }} <i class="fa-solid fa-gem gem-change-color"></i></td>
                </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
