<div class="card-header"><i class="fas fa-money-bill-alt"></i> My Balance</div>
<div class="card-body p-3 d-flex align-items-center">
	<i class="fas fa-gem p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
	<div>
		<div class="text-value-sm" style="color:#0e4d22" id="winners-gem" data-amount="{{ $income["gemBalance"] }}">{{ number_format($income["gemBalance"], 2) }} <i class="fas fa-gem" style="font-size:0.8em"></i></div>
		<div class="text-muted text-uppercase font-weight-bold small">Winners Gem</div>
	</div>
</div>
<div class="card-body px-3 pb-3 pt-0 d-flex align-items-center">
	<i class="fas fa-money-bill-alt p-3 font-2xl mr-3" style="background-color:#0e4d22; color:#ffffff"></i>
	<div>
		<div class="text-value-sm" style="color:#0e4d22" id="winners-gem" data-amount="{{ $income["pesoBalance"] }}">&#8369; {{ number_format($income["pesoBalance"], 2) }}</div>
		<div class="text-muted text-uppercase font-weight-bold small">Peso Balance</div>
	</div>
</div>
<div class="card-footer px-3 py-2">
    <input type="hidden" name="purchase-winners-gem-route" value="{{ route('products.purchaseWinnersGem') }}" />
	<a class="btn-block text-muted d-flex justify-content-between align-items-center" href="!#" data-toggle="modal" data-target="#modal-gem-purchase">
		<span class="small font-weight-bold">Buy Winners Gem</span>
		<i class="fa fa-angle-right"></i>
	</a>
</div>
