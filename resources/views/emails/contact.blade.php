<!DOCTYPE html>
<html>
<head>
    <title>Thông tin liên hệ mới</title>
</head>
<body>
    <h2>Thông tin liên hệ từ website</h2>
    <p><strong>Họ và tên:</strong> {{ $mailData['name'] }}</p>
    <p><strong>Email người gửi:</strong> {{ $mailData['email'] }}</p>
    <p><strong>Số điện thoại:</strong> {{ $mailData['phone'] }}</p>
    <p><strong>Nội dung:</strong></p>
    <p>{{ $mailData['message'] }}</p>
</body>
</html> 