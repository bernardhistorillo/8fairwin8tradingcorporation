<div class="modal fade" id="modal-convert" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Convert</h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link convert-tab active" data-bs-toggle="tab" data-type="peso-to-gem" href="#peso-to-gem-tab" role="tab" aria-controls="peso-to-gem-tab" aria-selected="true">Peso to Winners Gem</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link convert-tab" data-bs-toggle="tab" data-type="gem-to-peso" href="#gem-to-peso-tab" role="tab" aria-controls="gem-to-peso-tab" aria-selected="false">Winners Gem to Peso</a>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="peso-to-gem-tab" role="tabpanel" aria-labelledby="peso-to-gem-tab">
                        <label class="convert-amount-label" for="convert-amount">Enter Amount <small>(Minimum: <i class="fas fa-gem gem-change-color"></i> 1.00)</small></label>
                        <div class="position-relative mb-3">
                            <input class="form-control form-control-1 px-5 py-2 text-center" id="convert-peso-to-gem-amount" type="number" step="any" min="1" value="1" placeholder="Enter Amount">
                            <div class="position-absolute" style="right:20px; top:9px">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>

                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr style="background-color:#eeeeee">
                                    <th>Winners Gem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span id="convert-total-winners-gem">{{ number_format(1 / winnersGemValue(),2) }}</span>
                                        <i class="fas fa-gem gem-change-color"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="gem-to-peso-tab" role="tabpanel" aria-labelledby="gem-to-peso-tab">
                        <label class="convert-amount-label" for="convert-amount">Enter Amount <small>(Minimum: 500.00 Winners Gem)</small></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold px-0" style="width:40px; display:block">
                                    <i class="fas fa-gem gem-change-color"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control text-center" id="convert-gem-to-peso-amount" step="any" min="500" value="500">
                        </div>

                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr style="background-color:#eeeeee">
                                <th>Peso</th>
                                <th>Fee (2%)</th>
                                <th>Winners Gem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa-solid fa-peso-sign"></i>&nbsp;<span id="convert-total-peso">{{ number_format(500 * winnersGemValue(), 2) }}</span></td>
                                <td>
                                    <i class="fa-solid fa-peso-sign"></i>&nbsp;<span id="convert-gem-to-peso-fee-peso">{{ number_format((500 * winnersGemValue()) * 0.02, 2) }}</span>
                                    <div style="font-size:0.9em">
                                        (<span id="convert-gem-to-peso-fee-gem">{{ number_format(((500 * winnersGemValue()) * 0.02) / winnersGemValue(),2) }}</span>
                                        <i class="fas fa-gem gem-change-color"></i>)
                                    </div>
                                </td>
                                <td>
                                    <span id="convert-gem-to-peso-total-gems">{{ number_format(500 * 1.02,2) }}</span>
                                    <i class="fas fa-gem gem-change-color"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-5 px-4 cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-2 px-4 proceed" id="convert-confirm">Convert</button>
            </div>
        </div>
    </div>
</div>
