<nav id="products-tab-container" class="nav nav-pills nav-justified {{ (!$showProductsTab) ? 'd-none' : '' }}" data-hidden="{{ (!$showProductsTab) ? '1' : '0' }}">
	<a class="nav-link active products-tab" data-type="2" style="cursor:pointer">Products</a>
	<a class="nav-link products-tab" data-type="1" data-package-id="{{ ($terminalAccount) ? $terminalAccountDetails["package_id"] : Auth::user()->package_id }}" style="cursor:pointer">Packages</a>
</nav>

@if(!$terminalAccount)
<div class="card d-lg-none mt-4">
	@include('products.includes.myBalanceCardContent')
</div>
@endif

<div class="row mt-4">
	<div class="col-lg-6 col-xl-8">
		<div class="card">
			<div class="card-body" style="padding-bottom:0px">
				<div class="row px-1">
					@foreach($items as $item)
					<div class="col-md-6 col-lg-12 col-xl-6 px-2 products-section {{ ($item["type"] == 1) ? 'd-none' : '' }}" data-type="{{ $item["type"] }}" data-package-id="{{ $item["package_id"] }}">
						<div class="brand-card product-container mb-3" data-id="{{ $item["id"] }}" data-name="{{ $item["name"] }}" data-price="{{ ((!$terminalAccount && Auth::user()->package_id > 0) || ($terminalAccount && $terminalAccountDetails["package_id"] > 0)) ? $item["distributors_price"] / $winnersGemValue : $item["suggested_retail_price"] / $winnersGemValue }}" data-points="{{ $item["points_value"] }}" data-center-price="{{ $item["center_price"] / $winnersGemValue }}" data-mobile-price="{{ $item["mobile_price"] / $winnersGemValue }}" data-distributors-price="{{ $item["distributors_price"] / $winnersGemValue }}" data-srp="{{ $item["suggested_retail_price"] / $winnersGemValue }}" data-quantity="1">
                            @if(!$terminalAccount)
						   	<span class="stock d-none">{{ $item->terminalItemStock(Auth::user()->id, Auth::user()->stockist)['inStock'] }}</span>
							@endif
							<a href="{{ $item->photo() }}" data-fancybox="images" data-caption="{{ $item["name"] }}" style="text-align:center">
								<div class="image-container" style="display:inline-block; width:160px">
									<div style="position:relative; width:100%; padding-top:100%; overflow:hidden">
										<img class="item-photo-display" src="{{ $item->photo() }}" style="{{ ($item->longestDimension() == "width") ? 'height:auto; width:100%;' : 'height:100%; width:auto;' }} margin:0; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)" alt="item-image" />
									</div>
								</div>
							</a>
							<div class="brand-card-header text-center" style="background-color:#0e4d22; height:40px">
								<span class="name" style="font-size:1.3em; color:#ffffff; line-height:1em">{{ $item["name"] }}</span>
							</div>
							<div class="brand-card-body">
								<table style="width:100%">
									<tr>
										<td class="p-2" style="border-right:1px solid #dddddd; vertical-align:inherit">
											<div class="text-value crossed-price" style="font-size:0.95em; line-height:10px"><span style="text-decoration:line-through">{{ number_format($item["suggested_retail_price"] / $winnersGemValue, 2) }} <i class="fas fa-gem" style="font-size:0.8em"></i></span></div>
											<div class="text-value">
										 		<span class="price">{{ ((!$terminalAccount && Auth::user()->package_id > 0) || ($terminalAccount && $terminalAccountDetails["package_id"] > 0)) ? number_format($item["distributors_price"] / $winnersGemValue, 2) : number_format($item["suggested_retail_price"] / $winnersGemValue, 2) }}</span>
											 	&nbsp;<i class="fas fa-gem" style="font-size:0.8em"></i>
											</div>
											<div class="text-uppercase text-muted small">Winners Gem</div>

											<hr class="mt-2" style="margin-bottom:10px">

											<div class="text-value" style="font-size:1.2em; line-height:18px">{{ number_format($item["points_value"]) }} PV</div>
											<div class="text-uppercase text-muted small">Points Value</div>
										</td>
										<td class="p-2" style="vertical-align:inherit">
											<button class="btn cart" value="{{ $item["id"] }}" data-added-to-cart="-1" data-type="{{ $item["type"] }}" style="background-color:#0e4d22; color:#ffffff; font-size:0.85em; padding-top:10px">
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
		</div>
	</div>

	<div class="col-lg-6 col-xl-4">
        @if(!$terminalAccount)
		<div class="card d-none d-lg-block">
            @include('products.includes.myBalanceCardContent')
		</div>
		@endif

		<div class="card">
			<div class="card-header"><i class="fas fa-shopping-cart"></i> Cart</div>
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
							@if((!$terminalAccount && Auth::user()->package_id > 0) || ($terminalAccount && $terminalAccountDetails["package_id"] > 0))
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

		<div class="card">
			<div class="card-header"><i class="fas fa-truck"></i> Shipping Details</div>
			<div class="card-body">
				<div class="form-group">
					<small>Full Name</small>
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-user"></i>
							</span>
						</span>
						<input type="text" class="form-control" id="full-name" placeholder="Full Name" />
					</div>
				</div>

				<div class="form-group">
					<small>Contact Number</small>
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-phone"></i>
							</span>
						</span>
						<input type="text" class="form-control" id="contact-number" placeholder="Contact Number" />
					</div>
				</div>

				<div class="form-group">
					<small>Barangay</small>
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-map-marker-alt"></i>
							</span>
						</span>
						<input type="text" class="form-control" id="barangay" placeholder="Barangay" />
					</div>
				</div>

				<div class="form-group">
					<small>City</small>
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-map-marker-alt"></i>
							</span>
						</span>
						<input type="text" class="form-control" id="city" placeholder="City" />
					</div>
				</div>

				<div class="form-group">
					<small>Province</small>
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-map-marker-alt"></i>
							</span>
						</span>
						<input type="text" class="form-control" id="province" placeholder="Province" />
					</div>
				</div>

				<div class="form-group">
					<small>Zip Code</small>
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-map-marker-alt"></i>
							</span>
						</span>
						<input type="text" class="form-control" id="zip-code" placeholder="Zip Code" />
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<button class="btn btn-success btn-lg" id="place-order-confirm" data-terminal-account="{{ ($terminalAccount) ?? 0 }}" data-stockist="0" style="background-color:#0e4d22; width:100%">Place Order</button>
			</div>
		</div>
	</div>
</div>
