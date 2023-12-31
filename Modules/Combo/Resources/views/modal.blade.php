<div class="modal fade" id="store_or_update_modal" tabindex="-1" role="dialog" aria-labelledby="model-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">

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
                    <x-form.selectbox labelName="Combo Category Name" name="combo_category_id" required="required" col="col-md-6" class="selectpicker">
                        @if (!$ComboCategories->isEmpty())
                            @foreach ($ComboCategories as $ComboCategory)
                            <option value="{{ $ComboCategory->id }}">{{ $ComboCategory->name }}</option>
                            @endforeach
                        @endif
                    </x-form.selectbox>

                    <x-form.textbox type="number" labelName="Combo Sale Price" name="sale_price" col="col-md-3" placeholder="Enter Combo Sale Price" />

                    <x-form.textbox type="number" labelName=" Combo Offer Price" name="offer_price" col="col-md-3" placeholder="Enter Combo Offer Price"/>

                    <x-form.textbox labelName="Combo Name" name="title" required="required" col="col-md-6" placeholder="Enter Combo Name"/>

                    <x-form.textbox type="date" labelName="Offer Start" name="offer_start" col="col-md-3" />

                    <x-form.textbox type="date" labelName="Offer End" name="offer_end" col="col-md-3" />

                    <x-form.textbox type="number" labelName="Min Order Quantity" name="min_order_quantity" placeholder="Enter Min Order Quantity" col="col-md-6" />

                    <x-form.textbox type="number" labelName="Stock Quantity" name="stock_quantity" col="col-md-3" placeholder="Enter Stock Quantity"/>

                    <x-form.textbox type="number" labelName="Reorder Quantity" name="reorder_quantity" placeholder="Enter Reorder Quantity" col="col-md-3" />


                    <div class="form-group col-md-3">
                        <label for="title">Is Special Deal</label>
                        <li class="branch">
                            <input type="checkbox" id="is_special_deal" value="1" name="is_special_deal" class="form-check-input" >
                            <label class="form-check-label" for="is_special_deal">Yes</label>
                        </li>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="title">Is Manage Stock</label>
                        <li class="branch">
                            <input type="checkbox" value="1" name="is_manage_stock" id="is_manage_stock" class="form-check-input" >
                            <label class="form-check-label" for="is_manage_stock">Yes</label>
                        </li>
                    </div>
                    <div class="form-group col-md-6">
                    </div>

{{--                <x-form.selectbox onchange="getVariantOptionList(this.value,'row-0')" labelName="Variants" name="variant_id[]" required="required" col="col-md-3" class="selectpicker main-0">--}}
{{--                    @foreach ($variants as $variant)--}}
{{--                       <option value="{{ $variant->id }}">{{ $variant->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </x-form.selectbox>--}}


                    <x-form.selectbox labelName="Inventory" name="inventory_id[]" required="required" col="col-md-6" class="selectpicker main-0">
                        @if (!$Inventories->isEmpty())
                            @foreach ($Inventories as $Inventory)
                            <option value="{{ $Inventory->id }}">{{ $Inventory->title }}</option>
                            @endforeach
                        @endif
                    </x-form.selectbox>

                    {{-- <div class="form-group col-md-3 required">
                        <label for="variant_id[]">Variants</label>
                        <select name="variant_id[]" id="variant_id[]" class="form-control main-0 selectpicker" data-live-search="true" >
                            @if (!$Inventories->isEmpty())
                            @foreach ($Inventories as $Inventory)
                            <option value="{{ $Inventory->id }}">{{ $Inventory->title }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div> --}}

                    <div class="form-group col-md-6 ">
                       <input class="mt-5" type="button" id="addnew" value="Add New" onclick="addRow()">
                    </div>

                </div>

                <div id="content">
                </div>
            </div>
            <!-- /modal body -->

            <!-- Modal Footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" id="modal-close-btn" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-sm" id="save-btn"></button>
            </div>
            <!-- /modal footer -->
        </form>
      </div>
      <!-- /modal content -->

    </div>
  </div>
