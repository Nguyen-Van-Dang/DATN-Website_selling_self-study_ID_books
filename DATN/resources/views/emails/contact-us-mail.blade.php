<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo Liên Hệ Mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            max-width: 650px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #3498db;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        .header img {
            max-width: 80px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            text-align: center;nter;
        }

        .content {
            margin-top: 25px;
        }

        .content p {
            font-size: 16px;
            color: #555;
        }

        .content ul {
            list-style: none;
            padding-left: 0;
            font-size: 16px;
            color: #555;
        }

        .content ul li {
            padding: 8px 0;
        }

        .content ul li strong {
            color: #333;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #888;
            font-size: 14px;
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            display: block; /* Đảm bảo nút là block để căn giữa */
            margin: 20px auto; /* Căn giữa nút */
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 500;
            transition: background-color 0.3s;
            width: max-content; /* Nút sẽ có chiều rộng phù hợp với nội dung */
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn:focus {
            outline: none;
        }
        .ten{
            font-weight: bold;
            font-size: 15px
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">

         
            <h2>Thông Báo Liên Hệ Mới</h2>
        </div>

        <div class="content">
            <p class="ten">Xin chào Admin,</p>
            <p>Bạn có một thông báo mới từ người dùng:</p>
            <p><strong>Thông tin liên hệ:</strong></p>
            <ul>
                <li><strong>Tên:</strong> {{$contactData['name']}}</li>
                <li><strong>Email:</strong> {{$contactData['email']}}</li>
                <li><strong>Nội dung:</strong> {{$contactData['message']}}</li>
            </ul>
            <p>Vui lòng kiểm tra và phản hồi lại người dùng trong thời gian sớm nhất.</p>

            <a href="{{ url('/') }}" class="btn">Quay lại trang chủ</a>
        </div>

        <div class="footer">
            <p>Trân trọng, <br> Đội ngũ hỗ trợ</p>
        </div>
    </div>
</body>
</html>
