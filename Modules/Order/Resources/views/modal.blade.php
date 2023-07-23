<div class="modal fade" id="store_or_update_modal" tabindex="-1" role="dialog" aria-labelledby="model-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

      <!-- Modal Content -->
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="model-1"></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <!-- /modal header -->
        <form id="store_or_update_form" method="post">
          @csrf
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="update_id" id="update_id"/>
                    <x-form.textarea labelName="Shipping Address" required="required" name="shipping_address" col="col-md-6" placeholder="Enter shipping address" />

                    <x-form.textarea labelName="Billing Address" required="required" name="billing_address" col="col-md-6" placeholder="Enter billing address" />

                </div>

                <div class="row">
                    <x-form.textbox type="number" labelName="Shipping Charge" name="shipping_charge" col="col-md-6" placeholder="Enter shipping charge"/>
                    <x-form.selectbox labelName="Payment Method" name="payment_method_id" required="required" col="col-md-6 selectpicker">
                        @if (!$payment_methods->isEmpty())
                            @foreach ($payment_methods as $payment_method)
                            <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                            @endforeach
                        @endif
                    </x-form.selectbox>
                </div>

                <div class="row">
                    <x-form.textarea labelName="Payment Details" name="payment_details" col="col-md-6" placeholder="Enter payment details"/>
                    <x-form.textbox type="number" labelName="Payment Status" name="payment_status_id" col="col-md-6" placeholder="Enter payment status"/>
                </div>

                <div class="row">
                    <x-form.textbox type="number" labelName="Total" name="total" col="col-md-6" placeholder="Enter total"/>
                    <x-form.textbox type="number" labelName="Discount" name="discount" col="col-md-6" placeholder="Enter discount"/>
                </div>

                <div class="row">
                    <x-form.textbox type="number" labelName="Tax" name="tax" col="col-md-6" placeholder="Enter tax"/>
                    <x-form.textbox type="number" labelName="Grand Total" name="grand_total" col="col-md-6" placeholder="Enter grand total"/>
                </div>

            </div>
            <!-- /modal body -->

            <!-- Modal Footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-sm" id="save-btn"></button>
            </div>
            <!-- /modal footer -->
        </form>
      </div>
      <!-- /modal content -->

    </div>
  </div>
