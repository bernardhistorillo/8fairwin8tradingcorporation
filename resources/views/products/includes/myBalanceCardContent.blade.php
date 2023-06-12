<div class="card-header"><i class="fas fa-money-bill-alt me-2"></i> My Balance</div>
<div class="card-body p-3 d-flex align-items-center">
	<div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
        <div class="text-center">
            <i class="fa fa-gem p-3 font-size-140 text-white"></i>
        </div>
    </div>
	<div>
		<div class="text-value-sm" style="color:#0e4d22" id="winners-gem" data-amount="{{ $income["gemBalance"] }}">{{ number_format($income["gemBalance"], 2) }} <i class="fas fa-gem gem-change-color"></i></div>
		<div class="text-uppercase small">Winners Gem</div>
	</div>
</div>
<div class="card-body px-3 pb-3 pt-0 d-flex align-items-center">
    <div class="bg-color-2 d-flex justify-content-center align-items-center rounded-circle me-3" style="height:54px; width:54px">
        <div class="text-center">
            <i class="fa fa-money-bill-alt p-3 font-size-140 text-white"></i>
        </div>
    </div>
    <div>
		<div class="text-value-sm" style="color:#0e4d22" id="winners-gem" data-amount="{{ $income["pesoBalance"] }}"><i class="fa-solid fa-peso-sign"></i> {{ number_format($income["pesoBalance"], 2) }}</div>
		<div class="text-uppercase small">Peso Balance</div>
	</div>
</div>
<div class="card-footer px-3 py-2">
    <input type="hidden" name="purchase-winners-gem-route" value="{{ route('orders.purchaseWinnersGem') }}" />
	<a class="btn-block text-color-3 text-decoration-none d-flex justify-content-between align-items-center" href="!#" data-bs-toggle="modal" data-bs-target="#modal-gem-purchase">
		<span class="small">Buy Winners Gem</span>
		<i class="fa fa-angle-right"></i>
	</a>
</div>
