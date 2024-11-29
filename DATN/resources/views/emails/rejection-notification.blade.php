<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo Từ Chối Duyệt Tài Khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #e74c3c;
            color: white;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;
        }

        .content {
            margin-top: 20px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #888;
            font-size: 12px;
        }

        .btn {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            display: block;
            /* Đảm bảo nút là block để căn giữa */
            margin: 20px auto;
            /* Căn giữa nút */
        }

        .btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Thông Báo Từ Chối Duyệt Tài Khoản</h2>
        </div>

        <div class="content">
            <p>Xin chào {{ $name }},</p>
            <p>Rất tiếc! Tài khoản của bạn đã bị từ chối duyệt. Vui lòng liên hệ với quản trị viên để biết thêm chi
                tiết.</p>
            <p><strong>Thông tin người dùng:</strong></p>
            <ul>
                <li><strong>Tên người dùng:</strong> {{ $user->name }}</li>
                <li><strong>Số điện thoại:</strong> {{ $user->phone }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
            </ul>
            <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>

            <a href="{{ url('/') }}" class="btn">Quay lại trang chủ</a>
        </div>




        <div class="footer">
            <p>Trân trọng,<br>Đội ngũ Admin</p>
        </div>
    </div>
</body>

</html>
