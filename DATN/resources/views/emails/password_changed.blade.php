<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mật khẩu của bạn đã được thay đổi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #0dd6b8;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }

        .header img {
            width: 100px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
        }

        .content {
            padding: 20px;
            font-size: 16px;
            color: #333333;
        }

        .content p {
            margin: 15px 0;
        }

        .content .greeting {
            font-weight: bold;
            /* Chữ "Chào" sẽ được in đậm */
        }

        .button {
            display: inline-block;
            background-color: orange;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }

        .footer {
            background-color: #f4f7fc;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #777777;
        }

        .footer a {
            color: #0044cc;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>Mật khẩu của bạn đã được thay đổi</h2>
        </div>

        <div class="content">
            <p class="greeting">Chào {{ $name }},</p>
            <p>Chúng tôi muốn thông báo rằng mật khẩu của bạn đã được thay đổi thành công. Nếu bạn không thực hiện thay
                đổi này, vui lòng liên hệ với chúng tôi ngay lập tức.</p>

            <p>Thông tin tài khoản của bạn:</p>
            <ul>
                <li><strong>Thời gian thay đổi:</strong> {{ now()->format('d/m/Y H:i') }}</li>
            </ul>

            <p>Nếu bạn cần hỗ trợ thêm, đừng ngần ngại <a href="mailto:infobookstorefpt@gmail.com">liên hệ với chúng
                    tôi</a>.</p>

            <div style="text-align: center;">
                <a href="{{ route('handleLogin') }}" class="button">Đăng nhập lại</a>
            </div>
        </div>

        <div class="footer">
            <p>Trân trọng,<br>Website khóa học BookStore</p>
        </div>
    </div>
</body>

</html>
