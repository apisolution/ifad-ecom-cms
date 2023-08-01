<!DOCTYPE html>
<html>
<head>
    <style>
        .tablec thead th {
            color: #000 !important;
        }

        .tablec {
            width: 100%;
        }

        .text-bold {
            font-weight: bold;
            font-size:15px;
        }

        th,
        td {
            padding: 0.6em 1.5em;
            text-align: center;
        }

        .text-right {
            text-align: right !important;
        }

        .rowm {
            width:100%;
        }

        .mbm-4 {
            margin-bottom: 1.6rem !important;
        }

        .offset8 {
            margin-left: 66.6666666667%;
        }

        /* Custom Grid System */
        .col-4{
            width: 33.333%;
            padding: 0 1.6rem;
        }
        .left{
            float: left;
        }
        .col-md-5 {
            width: 41.666%;
        }
        /*.logo{*/
        /*    width:150px;*/
        /*    height:150px;*/
        /*}*/
        .color{
            color: #545454;
        }


    </style>
</head>
<body>
<div class="modal" id="view_modal">
    <div class="modal-dialog modal-lg">
        <!-- Modal Content -->
        <div class="modal-content">

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="rowm mbm-4">
                    <div class="col-4">
                        <img src="" class="logo" alt="Logo" />ddd

                    </div>

                    <div class="col-4 left offset8">
                        <label class="text-bold">Company: </label>&nbsp;<span class="color company_name_text">Company Real Name</span><br />
                        <label class="text-bold">Address: </label><span class="color company_address_text">Address</span>&nbsp;<br />
                        <label class="text-bold">Phone: </label>&nbsp;<span class="color company_phone_text">01325612222</span><br />
                        <label class="text-bold">Mail: </label>&nbsp;<span class="color company_mail_text">admin@mail.com</span>
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div class="rowm mbm-4">
                    <div class="col-4 left">
                        <h4 class="text-bold">Billing</h4>
                        <span class="billing color">{{ $order->billing_address }}</span>
                    </div>

                    <div class="col-4 left">
                        <h4 class="text-bold">Shipping</h4>
                        <span class="shipping color">{{$order->shipping_address}}</span>
                    </div>

                    <div class="col-4 left">
                        <h4 class="text-bold">Invoice</h4>
                        <label class="text-bold">Order ID: </label>&nbsp;<span class="color order_id"> #{{$order->id}}</span><br />
                        <label class="text-bold">Order Date: </label>&nbsp;<span class="color order_date"> {{date('d-m-Y',strtotime($order->order_date))}}</span><br />
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div class="rowm">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div class="rowm mbm-4">
                    <table class="tablec">
                        <thead>
                        <tr>
                            <th class="text-bold" scope="col">SKU</th>
                            <th class="text-bold" scope="col">PRODUCT NAME</th>
                            <th class="text-bold" scope="col">QTY</th>
                            <th class="text-bold" scope="col">PRICE</th>
                            <th class="text-bold" scope="col">ITEM TOTAL</th>
                        </tr>
                        </thead>
                        <tbody id="table_tr">
                        @php $i =1; @endphp
                        @foreach ($order->order_items as $order_item)
                            @if($order_item->type=='product')
                                $product = $order_item->inventory;
                            @elseif($order_item->type=='combo')
                                $product = $order_item->combo;
                            @endif

                            <tr>
                                <th class="color" scope="row">{{$i++}}</th>
                                <td class="color">{{$product->title}}</td>
                                <td class="color">1</td>
                                <td class="color">880BDT</td>
                                <td class="color">880BDT</td>
                            </tr>
                        @endforeach
                        <!-- Add more rows here -->
{{--                        <tr>--}}
{{--                            <td colspan="3"></td>--}}
{{--                            <td><span class="text-right">Shipping </span></td>--}}
{{--                            <td><span class="text-right">BDT 60</span></td>--}}
{{--                        </tr>--}}

                        <tr>
                            <td colspan="3"></td>
                            <td><span class="text-right text-bold">Grand Total</span></td>
                            <td><span class="text-right text-bold">BDT 1,325</span></td>
                        </tr>

                        <tr>
                            <td class="text-bold" colspan="5"><hr></td>
                        </tr>

                        <tr>
                            <td class="text-bold" colspan="5"><div class="text-bold left">Authorize</div></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /modal body -->

        </div>
        <!-- /modal content -->
    </div>
</div>
</body>
</html>
