<!DOCTYPE html>
<html>
<head>
    <title> Order Status Changed</title>
</head>
<body>
    <h3>Customer Name: {{$orderStatus['customer_name']}}</h3>
    <p>Invoice ID: IFAD-{{$orderStatus['order_id'] }}</p>
    <p>The order status has been changed to: {{ $orderStatus['status'] }}</p>
</body>
</html>