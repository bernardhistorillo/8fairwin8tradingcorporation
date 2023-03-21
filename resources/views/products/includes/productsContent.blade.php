@if(!$terminalUser)
<div class="card d-lg-none mt-4 mb-4">
	@include('products.includes.myBalanceCardContent')
</div>
@endif

<div class="row mt-4">
	<div class="col-lg-6 col-xl-8">
        <nav id="products-tab-container" class="nav nav-pills nav-justified mb-4 {{ (!$showProductsTab) ? 'd-none' : '' }}" data-hidden="{{ (!$showProductsTab) ? '1' : '0' }}">
            <a class="nav-link active products-tab" data-type="2" style="cursor:pointer">Products</a>
            <a class="nav-link products-tab" data-type="1" data-package-id="{{ ($terminalUser) ? $terminalUserDetails["package_id"] : Auth::user()->package_id }}" style="cursor:pointer">Packages</a>
        </nav>

        <div class="row px-1">
            @foreach($items as $item)
            <div class="col-md-6 col-lg-12 col-xl-6 px-2 products-section {{ ($item["type"] == 1) ? 'd-none' : '' }}" data-type="{{ $item["type"] }}" data-package-id="{{ $item["package_id"] }}">
                <div class="card product-container mb-3" data-id="{{ $item["id"] }}" data-name="{{ $item["name"] }}" data-price="{{ ((!$terminalUser && Auth::user()->package_id > 0) || ($terminalUser && $terminalUserDetails["package_id"] > 0)) ? $item["distributors_price"] / $winnersGemValue : $item["suggested_retail_price"] / $winnersGemValue }}" data-points="{{ $item["points_value"] }}" data-center-price="{{ $item["center_price"] / $winnersGemValue }}" data-mobile-price="{{ $item["mobile_price"] / $winnersGemValue }}" data-distributors-price="{{ $item["distributors_price"] / $winnersGemValue }}" data-srp="{{ $item["suggested_retail_price"] / $winnersGemValue }}" data-quantity="1">
                    @if(!$terminalUser)
                    <span class="stock d-none">{{ $item->terminalItemStock(Auth::user()->id, Auth::user()->stockist)['inStock'] }}</span>
                    @endif
                    <a href="{{ $item->photo() }}" class="d-block w-100" data-fancybox="images" data-caption="{{ $item["name"] }}" style="text-align:center">
                        <div class="image-container text-center w-100" style="display:inline-block; max-width:200px">
                            <div class="text-center" style="position:relative; width:100%; padding-top:100%; overflow:hidden">
                                <img class="item-photo-display" src="{{ $item->photo() }}" style="{{ ($item->longestDimension() == "width") ? 'height:auto; width:100%;' : 'height:100%; width:auto;' }} margin:0; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)" alt="item-image" />
                            </div>
                        </div>
                    </a>
                    <div class="brand-card-header d-flex align-items-center justify-content-center" style="background-color:#0e4d22; height:40px">
                        <div class="text-center">
                            <span class="name font-size-120" style="color:#ffffff; line-height:1em">{{ $item["name"] }}</span>
                        </div>
                    </div>
                    <div class="brand-card-body">
                        <table style="width:100%">
                            <tr>
                                <td class="p-2" style="border-right:1px solid #dddddd; vertical-align:inherit">
                                    <div class="text-value crossed-price text-center" style="font-size:0.95em; line-height:10px"><span style="text-decoration:line-through">{{ number_format($item["suggested_retail_price"] / $winnersGemValue, 2) }} <i class="fas fa-gem gem-change-color" style="font-size:0.8em"></i></span></div>
                                    <div class="text-value text-center">
                                        <span class="price">{{ ((!$terminalUser && Auth::user()->package_id > 0) || ($terminalUser && $terminalUserDetails["package_id"] > 0)) ? number_format($item["distributors_price"] / $winnersGemValue, 2) : number_format($item["suggested_retail_price"] / $winnersGemValue, 2) }}</span>&nbsp;<i class="fas fa-gem gem-change-color" style="font-size:0.8em"></i>
                                    </div>
                                    <div class="text-uppercase text-muted text-center small">Winners Gem</div>

                                    <hr class="mt-2" style="margin-bottom:10px">

                                    <div class="text-value text-center" style="line-height:18px">{{ number_format($item["points_value"]) }} PV</div>
                                    <div class="text-uppercase text-muted small text-center">Points Value</div>
                                </td>
                                <td class="p-2 text-center" style="vertical-align:inherit">
                                    <button class="btn btn-custom-2 cart" value="{{ $item["id"] }}" data-added-to-cart="-1" data-type="{{ $item["type"] }}" style="font-size:0.85em; padding-top:12px">
                                        <div><i class="fas fa-shopping-cart" style="color:#ffffff; font-size:1.4em"></i></div>
                                        <div style="margin-top:2px">Add To Cart</div>
                                    </button>
                                </td>
                            </tr>
                        </table>
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
							@if((!$terminalUser && Auth::user()->package_id > 0) || ($terminalUser && $terminalUserDetails["package_id"] > 0))
							<tr>
								<th class="text-left">Points</th>
								<td class="text-right"><span id="total-points">0</span> PV</td>
							</tr>
							@endif
							<tr>
								<th class="text-left">Price</th>
								<td class="text-right"><span id="total-price">0</span> <span style="font-size:0.8em">Gems</span></td>
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
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="full-name" type="text" placeholder="Full Name">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="contact-number" type="text" placeholder="Contact Number">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-phone"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="barangay" type="text" placeholder="Barangay">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="city" type="text" placeholder="City">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="province" type="text" placeholder="Province">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <div class="position-relative mb-2">
                    <input class="form-control form-control-1 ps-3 pe-5 py-2" id="zip-code" type="text" placeholder="Zip Code">
                    <div class="position-absolute" style="right:20px; top:9px">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
			</div>
		</div>

        <input type="hidden" name="place-order-route" value="{{ route('products.placeOrder') }}" />
        <button class="btn btn-success btn-lg" id="place-order-confirm" data-terminal-account="{{ ($terminalUser) ?? 0 }}" data-stockist="0" style="background-color:#0e4d22; width:100%">Place Order</button>
	</div>
</div>
