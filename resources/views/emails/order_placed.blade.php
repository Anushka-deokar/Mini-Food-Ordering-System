<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2 style="color: #2c3e50;">🛒 New Order Received</h2>

    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>

    <h4>Items:</h4>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->food->name }} × {{ $item->quantity }}</li>
        @endforeach
    </ul>

    <p>Thank you,<br>The TasteHub Team</p>
</body>

</html>