@if(!$terminalUser)
    <div class="card d-lg-none mt-4 mb-4">
        @include('products.includes.myBalanceCardContent')
    </div>
@endif

<div class="row">
    <div class="col-lg-6 col-xl-8">
        <nav id="products-tab-container"
             class="nav nav-pills nav-justified mb-4 {{ (!$showProductsTab) ? 'd-none' : '' }}"
             data-hidden="{{ (!$showProductsTab) ? '1' : '0' }}">
            <a class="nav-link active products-tab" data-type="2" style="cursor:pointer">Products</a>
            <a class="nav-link products-tab" data-type="1"
               data-package-id="{{ ($terminalUser) ? $terminalUser["package_id"] : Auth::user()->package_id }}"
               style="cursor:pointer">Packages</a>
        </nav>

        <div class="row align-items-stretch px-1">
            @foreach($items as $item)
                <div
                    class="col-md-6 col-lg-12 col-xl-6 px-2 products-section {{ ($item["type"] == 1) ? 'd-none' : '' }}"
                    data-type="{{ $item["type"] }}" data-package-id="{{ $item["package_id"] }}">
                    <div class="h-100 pb-4">
                        <div class="card border-radius-0 product-container h-100" data-id="{{ $item["id"] }}"
                             data-name="{{ $item["name"] }}"
                             data-price="{{ ((!$terminalUser && Auth::user()->package_id > 0) || ($terminalUser && $terminalUser["package_id"] > 0)) ? $item["distributors_price"] / winnersGemValue() : $item["suggested_retail_price"] / winnersGemValue() }}"
                             data-points="{{ $item["points_value"] }}"
                             data-center-price="{{ $item["center_price"] / winnersGemValue() }}"
                             data-mobile-price="{{ $item["mobile_price"] / winnersGemValue() }}"
                             data-distributors-price="{{ $item["distributors_price"] / winnersGemValue() }}"
                             data-srp="{{ $item["suggested_retail_price"] / winnersGemValue() }}" data-quantity="1">
                            @if($terminalUser)
                                <span
                                    class="stock d-none">{{ $item->terminalItemStock(Auth::user())['inStock'] }}</span>
                            @endif
                            <a href="{{ $item->photo() }}" class="d-block w-100" data-fancybox="images"
                               data-caption="{{ $item["name"] }}" style="text-align:center">
                                <div class="image-container text-center w-100"
                                     style="display:inline-block; max-width:200px">
                                    <div class="text-center"
                                         style="position:relative; width:100%; padding-top:100%; overflow:hidden">
                                        <img class="item-photo-display" src="{{ $item->photo() }}"
                                             style="{{ ($item->longestDimension() == "width") ? 'height:auto; width:100%;' : 'height:100%; width:auto;' }} margin:0; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)"
                                             alt="item-image"/>
                                    </div>
                                </div>
                            </a>
                            <div class="bg-color-5 d-flex align-items-center justify-content-center p-3 h-100"
                                 style="border-top:1px solid #cccccc; border-bottom:1px solid #cccccc">
                                <div class="text-center">
                                    <span class="name font-size-120" style="line-height:1em">{{ $item["name"] }}</span>
                                </div>
                            </div>
                            <div class="brand-card-body">
                                <div class="row align-items-stretch mx-0">
                                    <div class="col-6 px-0">
                                        <div
                                            class="text-uppercase text-muted text-center small h-100 p-2 bg-color-5 text-color-3 font-size-80"
                                            style="border-right:1px solid #cccccc; border-bottom:1px solid #cccccc">
                                            Price
                                        </div>
                                    </div>
                                    <div class="col-6 px-0">
                                        <div
                                            class="text-uppercase text-muted text-center small h-100 p-2 bg-color-5 text-color-3 font-size-80"
                                            style="border-bottom:1px solid #cccccc">Points Value
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-stretch mx-0">
                                    <div class="col-6 px-0">
                                        <div class="d-flex align-items-center justify-content-center h-100 p-2"
                                             style="border-right:1px solid #cccccc; border-bottom:1px solid #cccccc">
                                            <div>
                                                <div class="text-value crossed-price text-center font-size-80"
                                                     style="line-height:10px"><span
                                                        style="text-decoration:line-through">&nbsp;{{ number_format($item["suggested_retail_price"] / winnersGemValue(), 2) }} <i
                                                            class="fas fa-gem gem-change-color"
                                                            style="font-size:0.8em"></i></span>&nbsp;
                                                </div>
                                                <div class="text-value text-center">
                                                    <span
                                                        class="price">{{ ((!$terminalUser && Auth::user()->package_id > 0) || ($terminalUser && $terminalUser["package_id"] > 0)) ? number_format($item["distributors_price"] / winnersGemValue(), 2) : number_format($item["suggested_retail_price"] / winnersGemValue(), 2) }}</span>&nbsp;<i
                                                        class="fas fa-gem gem-change-color" style="font-size:0.8em"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 px-0">
                                        <div class="d-flex align-items-center justify-content-center h-100 p-2"
                                             style="border-bottom:1px solid #cccccc">
                                            <div class="text-value text-center"
                                                 style="line-height:18px">{{ number_format($item["points_value"]) }} PV
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-custom-2 font-size-90 w-100 p-2 cart" value="{{ $item["id"] }}"
                                        data-added-to-cart="-1" data-type="{{ $item["type"] }}">
                                    <div class="py-1">ADD TO CART</div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-lg-6 col-xl-4">
        @if(!$terminalUser)
            <div class="card mb-4 d-none d-lg-block">
                @include('products.includes.myBalanceCardContent')
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-shopping-cart me-2"></i> Cart</div>
            <div class="card-body">
                <h6><i class="fas fa-gift"></i>&nbsp;&nbsp;Items</h6>
                <div class="table-responsive" id="cart-container">
                    <table class="table table-bordered">
                        <tr>
                            <td>No Items Added Yet</td>
                        </tr>
                    </table>
                </div>

                <hr>

                <div id="total-container">
                    <h6 class="mt-4"><i class="fas fa-calculator"></i>&nbsp;&nbsp;Total</h6>
                    <div class="table-responsive" id="cart-container">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-left">Quantity</th>
                                <td class="text-right" id="total-quantity">0</td>
                            </tr>
                            @if((!$terminalUser && Auth::user()->package_id > 0) || ($terminalUser && $terminalUser["package_id"] > 0))
                                <tr>
                                    <th class="text-left">Points</th>
                                    <td class="text-right"><span id="total-points">0</span> PV</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="text-left">Price</th>
                                <td class="text-right"><span id="total-price">0</span> <i
                                        class="fa-solid fa-gem gem-change-color"></i></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-truck me-2"></i> Shipping Details</div>
            <div class="card-body">
                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="full-name" type="text"
                           placeholder="Full Name"
                           value="{{ ($latestShippingInformation) ? $latestShippingInformation['full_name'] : '' }}">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="contact-number" type="text"
                           placeholder="Contact Number"
                           value="{{ ($latestShippingInformation) ? $latestShippingInformation['contact_number'] : '' }}">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-phone"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="barangay" type="text"
                           placeholder="Barangay"
                           value="{{ ($latestShippingInformation) ? $latestShippingInformation['barangay'] : '' }}">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="city" type="text" placeholder="City"
                           value="{{ ($latestShippingInformation) ? $latestShippingInformation['city'] : '' }}">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="province" type="text"
                           placeholder="Province"
                           value="{{ ($latestShippingInformation) ? $latestShippingInformation['province'] : '' }}">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="zip-code" type="text"
                           placeholder="Zip Code"
                           value="{{ ($latestShippingInformation) ? $latestShippingInformation['zip_code'] : '' }}">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="place-order-route" value="{{ route('orders.placeOrder') }}"/>
        <button class="btn btn-custom-2 btn-lg w-100" id="place-order-confirm" data-terminal-user="{{ $terminalUser ? $terminalUser['encodedTerminalUserId'] : '0' }}" data-stockist="0">PLACE ORDER</button>
    </div>
</div>
