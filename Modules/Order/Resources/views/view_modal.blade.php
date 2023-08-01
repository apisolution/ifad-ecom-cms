<!-- CSS -->
<style>
    .tablec thead th {
        color: #000 !important;
    }

    .tablec {
        width: 100%;
    }

    .text-bold {
        font-weight: bold;
    }

    th,
    td {
        padding: 0.6em 1.5em;
    }

    .text-right {
        text-align: right !important;
    }

    .bold {
        font-weight: bold;
    }

    .rowm {
        display: flex;
        flex-wrap: wrap;
        margin-right: -1.6rem;
        margin-left: -1.6rem;
    }

    .mbm-4 {
        margin-bottom: 1.6rem !important;
    }
    .offset-8 {
        margin-left: 66.6666666667%;
    }

    /* Custom Grid System */
    .col-md-4{
        width: 33.333%;
        padding: 0 1.6rem;
    }
    .col-md-5 {
        width: 41.666%;
    }
    .logo{
        width:150px;
        height:150px;
    }
    @media (min-width: 768px) {
        .col-md-4 {
            width: 33.333%;
        }

        .col-md-5 {
            width: 41.666%;
        }
    }
</style>

<!-- HTML -->
<div class="modal" id="view_modal">
    <div class="modal-dialog modal-lg">
        <!-- Modal Content -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-white" id="model-1">Modal Title</h3>
                <span class="close" data-dismiss="modal" aria-label="Close">&times;</span>
            </div>
            <!-- /modal header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="rowm mbm-4">
                    <div class="col-md-4">
                        <img src="" class="logo" alt="Logo" />
                    </div>

                    <div class="col-md-4 offset-4">
                        <label class="text-bold">Company: </label>&nbsp;<span class="company_name_text">Company Real Name</span><br />
                        <label class="text-bold">Address: </label><span class="company_address_text">Address</span>&nbsp;<br />
                        <label class="text-bold">Phone: </label>&nbsp;<span class="company_phone_text">01325612222</span><br />
                        <label class="text-bold">Mail: </label>&nbsp;<span class="company_mail_text">admin@mail.com</span>
                    </div>
                </div>

                <div class="rowm mbm-4">
                    <div class="col-md-4">
                        <h4 class="text-bold">Billing</h4>
                        <span class="billing"></span>
                    </div>

                    <div class="col-md-4">
                        <h4 class="text-bold">Shipping</h4>
                        <span class="shipping"></span>
                    </div>

                    <div class="col-md-4">
                        <h4 class="text-bold">Invoice</h4>
                        <label class="text-bold">Order ID: </label>&nbsp;<span class="order_id"></span><br />
                        <label class="text-bold">Order Date: </label>&nbsp;<span class="order_date"></span><br />
                    </div>
                </div>

                <div class="rowm">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <div class="rowm mbm-4">
                    <table class="tablec">
                        <thead>
                        <tr>
                            <th class="text-uppercase" scope="col">SKU</th>
                            <th class="text-uppercase" scope="col">PRODUCT NAME</th>
                            <th class="text-uppercase" scope="col">QTY</th>
                            <th class="text-uppercase" scope="col">PRICE</th>
                            <th class="text-uppercase" scope="col">ITEM TOTAL</th>
                        </tr>
                        </thead>
                        <tbody id="table_tr">
{{--                        <tr>--}}
{{--                            <th scope="row">1</th>--}}
{{--                            <td>Chris</td>--}}
{{--                            <td>1</td>--}}
{{--                            <td><a href="javascript:void(0)" class="btn-link">880BDT</a></td>--}}
{{--                            <td><a href="javascript:void(0)" class="btn-link">880BDT</a></td>--}}
{{--                        </tr>--}}
                        <!-- Add more rows here -->
{{--                        <tr>--}}
{{--                            <td colspan="3"></td>--}}
{{--                            <td><span class="text-right">Shipping </span></td>--}}
{{--                            <td><span class="text-right">BDT 60</span></td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td colspan="3"></td>--}}
{{--                            <td><span class="text-right bold">Grand Total</span></td>--}}
{{--                            <td><span class="text-right bold">BDT 1,325</span></td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td class="bold" colspan="5"><hr></td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td class="bold" colspan="2"><span class="bold">Authorize</span></td>--}}
{{--                            <td class="bold text-right" colspan="3"><span class="text-right bold">Admin</span></td>--}}
{{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /modal body -->

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
            <!-- /modal footer -->
        </div>
        <!-- /modal content -->
    </div>
</div>
