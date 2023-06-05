<div class="modal fade" id="modal-gem-purchase" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-success" role="document">
		<div class="modal-content border-radius-0">
			<div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Purchase Winners Gem</h5>
				<div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
			</div>
			<div class="modal-body pb-2">
                <input type="hidden" name="purchase-winners-gem-route" value="{{ route('orders.purchaseWinnersGem') }}" />

				<div class="row">
					<div class="col-sm-6 px-2 mb-3">
						<small>Winners Gem</small>
                        <div class="position-relative mb-2">
                            <input class="form-control form-control-1 px-5 py-2 text-center" id="purchase-winners-gem-amount" type="number" placeholder="Winners Gem" value="0" min="0">
                            <div class="position-absolute" style="right:20px; top:9px">
                                <i class="fas fa-gem"></i>
                            </div>
                        </div>
					</div>

                    <div class="col-sm-6 px-2 mb-3">
                        <small>Total Price</small>
                        <div class="position-relative mb-2">
                            <input class="form-control form-control-1 px-5 py-2 text-center" id="purchase-winners-gem-price" type="number" placeholder="Total Price" value="0" min="0">
                            <div class="position-absolute" style="right:20px; top:9px">
                                <i class="fas fa-peso-sign"></i>
                            </div>
                        </div>
                    </div>
				</div>

				<div>
					<p class="text-center font-size-90 mb-0">Proof of Payment</p>
					<div class="row mt-2 no-gutters justify-content-center" id="proof-of-payment-container" style="margin-left:-4px; margin-right:-4px">
						<div class="col-6 px-1" style="margin-bottom:10px">
							<div class="proof-of-payment" data-has-image="0" style="width:100%; height:150px; border:2px solid #0e4d22; position:relative; cursor:pointer">
								<div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%)">
									<i class="fa-light fa-plus-circle font-size-250" style="color:#0e4d22"></i>
								</div>
							</div>
						</div>
					</div>

					<div id="proof-of-payment-content" class="d-none">
						<div class="col-6 px-1" style="margin-bottom:10px">
							<div class="proof-of-payment" data-has-image="0" style="width:100%; height:150px; border:2px solid #0e4d22; position:relative; cursor:pointer">
								<div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%)">
									<i class="fa-light fa-plus-circle font-size-250" style="color:#0e4d22"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal" style="width:129px">Cancel</button>
				<button type="button" class="btn btn-custom-2 px-4" id="purchase-winners-gem-show-modal" style="width:129px">Purchase</button>
			</div>
		</div>
	</div>
</div>
