<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせありがとうございました</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: "Hiragino Sans", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
            background-color: #ffffff;
        }

        .background-text {
            position: absolute;
            font-size: 180px;
            color: #f5f5f5;
            font-weight: bold;
            z-index: -1;
            user-select: none;
        }

        .content {
            text-align: center;
            z-index: 1;
        }

        .message {
            font-size: 24px;
            color: #666;
            margin-bottom: 40px;
        }

        .home-button {
            display: inline-block;
            padding: 10px 40px;
            background-color: #8B7355;
            color: white;
            text-decoration: none;
            border-radius: 2px;
            font-size: 16px;
        }

        .home-button:hover {
            background-color: #9e856a;
        }
    </style>
</head>
<body>
    <div class="background-text">Thank you</div>
    <div class="content">
        <p class="message">お問い合わせありがとうございました</p>
        <a href="#" class="home-button">HOME</a>
    </div>
</body>
</html>