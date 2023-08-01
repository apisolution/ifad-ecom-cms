<!DOCTYPE html>
<html>
<head>
    <title>Larave Generate Invoice PDF - Nicesnippest.com</title>
</head>
<style type="text/css">
    .logo{
        width:150px;
        height:150px;
    }

    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;
    }
    .w-85{
        width:85%;
    }
    .w-15{
        width:15%;
    }
    .w-33{
        width:33%;
    }
    .logo img{
        width:45px;
        height:45px;
        padding-top:30px;
    }
    .logo span{
        margin-left:8px;
        top:19px;
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
    /*.border{*/
    /*    border:1px solid #ccc;*/
    /*}*/
</style>
<body>

<div class="mt-10">
    <div class="w-33 float-left">
        <img src="" class="logo" alt="Logo" />
    </div>
    <div class="w-33 float-left">

    </div>
    <div class="w-33 float-left">
        <label class="text-bold">Company: </label>&nbsp;<span class="company_name_text">Company Real Name</span><br />
        <label class="text-bold">Address: </label><span class="company_address_text">Address</span>&nbsp;<br />
        <label class="text-bold">Phone: </label>&nbsp;<span class="company_phone_text">01325612222</span><br />
        <label class="text-bold">Mail: </label>&nbsp;<span class="company_mail_text">admin@mail.com</span>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="mt-10">
    <div class="w-33 float-left">
        <h4 class="text-bold">Billing</h4>
        <span class="billing"></span>
    </div>

    <div class="w-33 float-left">
        <h4 class="text-bold">Shipping</h4>
        <span class="shipping"></span>
    </div>

    <div class="w-33 float-left">
        <h4 class="text-bold">Invoice</h4>
        <label class="text-bold">Order ID: </label>&nbsp;<span class="order_id"></span><br />
        <label class="text-bold">Order Date: </label>&nbsp;<span class="order_date"></span><br />
    </div>
    <div style="clear: both;"></div>
</div>

<div class="rowm">
    <div class="col-md-12">
        <hr/>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
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
        <tr>
            <th scope="row">1</th>
            <td>Chris</td>
            <td>1</td>
            <td>880BDT</td>
            <td>880BDT</td>
        </tr>
        <!-- Add more rows here -->
{{--        <tr>--}}
{{--            <td colspan="3"></td>--}}
{{--            <td><span class="text-right">Shipping </span></td>--}}
{{--            <td><span class="text-right">BDT 60</span></td>--}}
{{--        </tr>--}}

        <tr>
            <td colspan="3"></td>
            <td><span class="text-right bold">Grand Total</span></td>
            <td><span class="text-right bold">BDT 1,325</span></td>
        </tr>

        <tr>
            <td class="bold" colspan="5">
                <span class="border"></span>
            </td>
        </tr>

        <tr>
            <td class="bold" colspan="5"><span class="bold">Authorize</span></td>

        </tr>
        </tbody>
    </table>
</div>

{{--<div class="head-title">--}}
{{--    <h1 class="text-center m-0 p-0">Invoice</h1>--}}
{{--</div>--}}
{{--<div class="add-detail mt-10">--}}
{{--    <div class="w-50 float-left mt-10">--}}
{{--        <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">#6</span></p>--}}
{{--        <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">162695CDFS</span></p>--}}
{{--        <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">03-06-2022</span></p>--}}
{{--    </div>--}}
{{--    <div class="w-50 float-left logo mt-10">--}}
{{--        <img src="https://www.nicesnippets.com/image/imgpsh_fullsize.png"> <span>Nicesnippets.com</span>--}}
{{--    </div>--}}
{{--    <div style="clear: both;"></div>--}}
{{--</div>--}}


{{--<div class="table-section bill-tbl w-100 mt-10">--}}
{{--    <table class="table w-100 mt-10">--}}
{{--        <tr>--}}
{{--            <th class="w-50">Payment Method</th>--}}
{{--            <th class="w-50">Shipping Method</th>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>Cash On Delivery</td>--}}
{{--            <td>Free Shipping - Free Shipping</td>--}}
{{--        </tr>--}}
{{--    </table>--}}
{{--</div>--}}
{{--<div class="table-section bill-tbl w-100 mt-10">--}}
{{--    <table class="table w-100 mt-10">--}}
{{--        <tr>--}}
{{--            <th class="w-50">SKU</th>--}}
{{--            <th class="w-50">Product Name</th>--}}
{{--            <th class="w-50">Price</th>--}}
{{--            <th class="w-50">Qty</th>--}}
{{--            <th class="w-50">Subtotal</th>--}}
{{--            <th class="w-50">Tax Amount</th>--}}
{{--            <th class="w-50">Grand Total</th>--}}
{{--        </tr>--}}
{{--        <tr align="center">--}}
{{--            <td>$656</td>--}}
{{--            <td>Mobile</td>--}}
{{--            <td>$204.2</td>--}}
{{--            <td>3</td>--}}
{{--            <td>$500</td>--}}
{{--            <td>$50</td>--}}
{{--            <td>$100.60</td>--}}
{{--        </tr>--}}
{{--        <tr align="center">--}}
{{--            <td>$656</td>--}}
{{--            <td>Mobile</td>--}}
{{--            <td>$254.2</td>--}}
{{--            <td>2</td>--}}
{{--            <td>$500</td>--}}
{{--            <td>$50</td>--}}
{{--            <td>$120.00</td>--}}
{{--        </tr>--}}
{{--        <tr align="center">--}}
{{--            <td>$656</td>--}}
{{--            <td>Mobile</td>--}}
{{--            <td>$554.2</td>--}}
{{--            <td>5</td>--}}
{{--            <td>$500</td>--}}
{{--            <td>$50</td>--}}
{{--            <td>$100.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="7">--}}
{{--                <div class="total-part">--}}
{{--                    <div class="total-left w-85 float-left" align="right">--}}
{{--                        <p>Sub Total</p>--}}
{{--                        <p>Tax (18%)</p>--}}
{{--                        <p>Total Payable</p>--}}
{{--                    </div>--}}
{{--                    <div class="total-right w-15 float-left text-bold" align="right">--}}
{{--                        <p>$20</p>--}}
{{--                        <p>$20</p>--}}
{{--                        <p>$330.00</p>--}}
{{--                    </div>--}}
{{--                    <div style="clear: both;"></div>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    </table>--}}
{{--</div>--}}
</html>
