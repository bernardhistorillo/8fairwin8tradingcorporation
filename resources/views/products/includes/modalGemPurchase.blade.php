<div class="modal fade" id="modal-gem-purchase" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-success" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#ffffff; color:#222222">
				<h5 class="modal-title">Purchase Winners Gem</h5>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6 mb-3">
						<small>Winners Gem</small>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text px-0" style="width:40px; display:block">
									<i class="fas fa-gem"></i>
								</span>
							</div>
							<input type="number" class="form-control text-center" id="purchase-winners-gem-amount" value="0" min="0" />
						</div>
					</div>
					
					<div class="col-sm-6 mb-3">
						<small>Total Price</small>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text px-0" style="width:40px; display:block; font-weight:bold">&#8369;</span>
							</div>
							<input type="number" class="form-control text-center" id="purchase-winners-gem-price" value="0" min="0" />
						</div>
					</div>
				</div>
				
				<div class="mb-2">
					<small>Proof of Payment</small>
					<div class="row mt-2 no-gutters" id="proof-of-payment-container" style="margin-left:-4px; margin-right:-4px">
						<div class="col-6 px-1" style="margin-bottom:10px">
							<div class="proof-of-payment" data-has-image="0" style="width:100%; height:180px; background-color:#eeeeee; border:2px solid #0e4d22; position:relative; cursor:pointer">
								<div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%)">
									<i class="fas fa-plus-circle fa-3x" style="color:#0e4d22"></i>
								</div>
							</div>
						</div>
					</div>
					
					<div id="proof-of-payment-content" class="d-none">
						<div class="col-6 px-1" style="margin-bottom:10px">
							<div class="proof-of-payment" data-has-image="0" style="width:100%; height:180px; background-color:#eeeeee; border:2px solid #0e4d22; position:relative; cursor:pointer">
								<div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%)">
									<i class="fas fa-plus-circle fa-3x" style="color:#0e4d22"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-success" id="purchase-winners-gem-show-modal" style="background-color:#0e4d22; color:#ffffff">Purchase</button>
			</div>
		</div>
	</div>
</div>