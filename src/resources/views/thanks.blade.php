<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Thanks</title>
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>
<body>

    <div class="thanks-wrapper">

        <!-- 背景の大きな文字 -->
        <div class="background-text">
            Thank you
        </div>

        <!-- 中央コンテンツ -->
        <div class="thanks-content">
            <p class="message">お問い合わせありがとうございました</p>

            <a href="{{ route('contact.index') }}" class="home-btn">
                HOME
            </a>
        </div>

    </div>

</body>
</html>