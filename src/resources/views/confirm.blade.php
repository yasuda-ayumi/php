<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>
<body>

<h1 class="site-title">FashionablyLate</h1>
<div class="header-line"></div>

<div class="wrapper">
    <h2 class="page-title">Confirm</h2>

    <div class="confirm-table">

        <!-- お名前 -->
        <div class="confirm-row">
            <div class="label">お名前</div>
            <div class="value">
                <span class="last-name">{{ $data['last_name'] }}</span>
                <span class="first-name">{{ $data['first_name'] }}</span>
            </div>
        </div>

        <!-- 性別 -->
        <div class="confirm-row">
            <div class="label">性別</div>
            <div class="value">
                @if($data['gender'] == 1)
                    男性
                @elseif($data['gender'] == 2)
                    女性
                @else
                    その他
                @endif
            </div>
        </div>

        <!-- メール -->
        <div class="confirm-row">
            <div class="label">メールアドレス</div>
            <div class="value">
                {{ $data['email'] }}
            </div>
        </div>

        <!-- 電話番号 -->
        <div class="confirm-row">
            <div class="label">電話番号</div>
            <div class="value">
                {{ $data['tel1'] }}{{ $data['tel2'] }}{{ $data['tel3'] }}
            </div>
        </div>

        <!-- 住所 -->
        <div class="confirm-row">
            <div class="label">住所</div>
            <div class="value">
                {{ $data['address'] }}
            </div>
        </div>

        <!-- 建物名 -->
        <div class="confirm-row">
            <div class="label">建物名</div>
            <div class="value">
                {{ $data['building'] }}
            </div>
        </div>

        <!-- お問い合わせの種類 -->
        <div class="confirm-row">
            <div class="label">お問い合わせの種類</div>
            <div class="value">
                {{ $category->content }}
            </div>
        </div>

        <!-- お問い合わせ内容 -->
        <div class="confirm-row content-row">
            <div class="label">お問い合わせ内容</div>
            <div class="value">
                {!! nl2br(e($data['detail'])) !!}
            </div>
        </div>

    </div>

    <div class="btn-area">

        <!-- 送信 -->
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf

            @foreach($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <button type="submit" class="submit-btn">送信</button>
        </form>

        <!-- 修正 -->
        <form action="{{ route('contact.back') }}" method="POST">
            @csrf

            @foreach($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <button type="submit" class="back-btn">修正</button>
        </form>

    </div>

</div>

</body>
</html>