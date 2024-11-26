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
        }
        .btn:hover {
            background-color: #c0392b;
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
