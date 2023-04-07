<input type="hidden" id="view-items-route" value="{{ route('orders.viewItems') }}" />

<div class="modal fade" id="modal-view-order-items" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-radius-0">
            <div class="modal-header justify-content-center position-relative" style="background-color:#ffffff; color:#222222">
                <h5 class="modal-title text-center">Order: <span id="order-reference"></span></h5>
                <div class="position-absolute" style="right:18px; top:18px">
                    <button class="close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive" id="ordered-items-container"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-2 px-4 proceed" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
