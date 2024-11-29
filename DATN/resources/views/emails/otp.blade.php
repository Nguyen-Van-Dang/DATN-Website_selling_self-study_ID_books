<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận mã OTP</title>
    <style>
        .email-container {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #0dd6b8;
            text-align: center;
            padding: 20px;
        }
        .header img {
            max-width: 100px;
        }
        .header h2 {
            color: #333;
            margin-top: 10px;
        }
        .content {
            padding: 20px;
            color: #555;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #d9534f;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">

            <h2>Xác nhận mã OTP của bạn</h2>
        </div>
        <div class="content">
            <p class="greeting">Chào bạn,</p>
            <p>Để tiếp tục thay đổi mật khẩu, vui lòng sử dụng mã OTP bên dưới:</p>
            <div class="otp-code">{{ $otp }}</div>
            <p>Mã OTP này sẽ hết hạn sau <span>1 phút</span> . Vui lòng không chia sẻ mã này với bất kỳ ai vì lý do bảo mật.</p>
            <p>Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng bỏ qua email này hoặc liên hệ với chúng tôi để được hỗ trợ.</p>
        </div>
        <div class="footer">
            <p>Trân trọng,<br>Đội ngũ hỗ trợ BookStore</p>
        </div>
    </div>
</body>
</html>
