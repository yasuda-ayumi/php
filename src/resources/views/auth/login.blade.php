<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<div class="header">
    <h1>FashionablyLate</h1>
    <a href="{{ route('register') }}">
        <button type="button" class="login-btn">register</button>
    </a>
</div>

<div class="title">Login</div>

<div class="card">
<form method="POST" action="{{ route('login') }}">
@csrf

<label>メールアドレス</label>
<input type="text" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
@error('email')
<div class="error">{{ $message }}</div>
@enderror

<label>パスワード</label>
<input type="password" name="password" placeholder="例: coachtech1106">
@error('password')
<div class="error">{{ $message }}</div>
@enderror

<button type="submit" class="register-btn">ログイン</button>

</form>
</div>

</body>
</html>