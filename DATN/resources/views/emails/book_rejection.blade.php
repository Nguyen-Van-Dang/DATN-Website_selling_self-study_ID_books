<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo Từ Chối Duyệt Sách</title>
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
            background-color: #e74c3c;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
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
            background-color: #4CAF50 ;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 500;
            transition: background-color 0.3s;
            text-align: center;
        }

        .btn:hover {
            background-color: #c0392b;
        }

        .btn:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thông Báo Từ Chối Duyệt Sách</h2>
        </div>

        <div class="content">
            <p>Xin chào {{ $book->user->name }},</p>
            <p>Rất tiếc, sách của bạn "<strong>{{ $book->name }}</strong>" không được duyệt. Vui lòng kiểm tra lại thông tin và thử lại sau.</p>
            <p><strong>Thông tin sách:</strong></p>
            <ul>
                <li><strong>Tên sách:</strong> {{ $book->name }}</li>
                <li><strong>Giá sách:</strong> {{ number_format($book->price, 0, ',', '.') }} VNĐ</li>
                <li><strong>Mô tả:</strong> {{ $book->description }}</li>
            </ul>
            <p>Chúng tôi rất tiếc về sự bất tiện này. Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>

            <a href="{{ url('/') }}" class="btn">Quay lại trang chủ</a>
        </div>

        <div class="footer">
            <p>Trân trọng, <br> Đội ngũ hỗ trợ</p>
        </div>
    </div>
</body>
</html>
