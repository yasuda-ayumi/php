<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<div class="header">
    <h1>FashionablyLate</h1>
    <a href="{{ route('login') }}">
        <button type="button" class="login-btn">login</button>
    </a>
</div>

<div class="title">Register</div>

<div class="card">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>お名前</label>
        <input type="text" name="name" value="{{ old('name') }}"placeholder="例: 山田　太郎" >
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>メールアドレス</label>
        <input type="text" name="email" value="{{ old('email') }}"placeholder="例: test@example.com" >
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>パスワード</label>
        <input type="password" name="password" placeholder="例: coachtech1106">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="register-btn">登録</button>
    </form>
</div>

</body>
</html>