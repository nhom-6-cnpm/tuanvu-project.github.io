<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận đơn hàng</title>
</head>
<body>
    <h2>Xin chào {{ $order['name'] }},</h2>
    <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xác nhận.</p>
    
    <h3>Thông tin đơn hàng:</h3>
    <p>Tên: {{ $order['name'] }}</p>
    <p>Số điện thoại: {{ $order['phone'] }}</p>
    <p>Địa chỉ: {{ $order['address'] }}</p>
    <p>Email: {{ $order['email'] }}</p>
    
    <p>Chúng tôi sẽ liên hệ với bạn sớm nhất.</p>
    
    <p>Trân trọng,<br>
    {{ config('app.name') }}</p>
</body>
</html> 