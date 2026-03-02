<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>

<h1 class="site-title">FashionablyLate</h1>
<div class="header-line"></div>

<div class="wrapper">
    <h2 class="page-title">Contact</h2>

    <form class="contact-form" action="/confirm" method="POST">
        @csrf

        <!-- お名前 -->
        <div class="form-row">
            <label>お名前 <span class="required">※</span></label>

            <div class="form-input">
                <div class="name-group">
                    <div>
                        <input type="text" name="last_name"
                            value="{{ old('last_name') }}"
                            placeholder="例: 山田">
                        @error('last_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="first_name"
                            value="{{ old('first_name') }}"
                            placeholder="例: 太郎">
                        @error('first_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 性別 -->
        <div class="form-row">
            <label>性別 <span class="required">※</span></label>

            <div class="form-input">
                <div class="radio-group">

                    <label>
                        <input type="radio" name="gender" value="1"
                            {{ old('gender', 1) == 1 ? 'checked' : '' }}>
                        男性
                    </label>

                    <label>
                        <input type="radio" name="gender" value="2"
                            {{ old('gender') == 2 ? 'checked' : '' }}>
                        女性
                    </label>

                    <label>
                        <input type="radio" name="gender" value="3"
                            {{ old('gender') == 3 ? 'checked' : '' }}>
                        その他
                    </label>

                </div>

                @error('gender')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- メール -->
        <div class="form-row">
            <label>メールアドレス <span class="required">※</span></label>

            <div class="form-input">
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    placeholder="例: test@example.com">

                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- 電話番号 -->
         <div class="form-row">
    <label>電話番号 <span class="required">※</span></label>

    <div class="tel-wrapper">
        <div class="tel-input">
            <input type="text" name="tel1" maxlength="5" value="{{ old('tel1') }}">
            <span>-</span>
            <input type="text" name="tel2" maxlength="5" value="{{ old('tel2') }}">
            <span>-</span>
            <input type="text" name="tel3" maxlength="5" value="{{ old('tel3') }}">
    </div>

    @error('tel1')
        <p class="error-message">{{ $message }}</p>
    @enderror

    @error('tel2')
        <p class="error-message">{{ $message }}</p>
    @enderror

    @error('tel3')
        <p class="error-message">{{ $message }}</p>
    @enderror
</div>
</div>

        <!-- 住所 -->
        <div class="form-row">
            <label>住所 <span class="required">※</span></label>

            <div class="form-input">
                <input type="text" name="address"
                    value="{{ old('address') }}"
                    placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">

                @error('address')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- 建物名 -->
        <div class="form-row">
            <label>建物名</label>

            <div class="form-input">
                <input type="text" name="building"
                    value="{{ old('building') }}"
                    placeholder="例: 千駄ヶ谷マンション101">
            </div>
        </div>

        <!-- お問い合わせの種類 -->
        <div class="form-row">
            <label>お問い合わせの種類 <span class="required">※</span></label>

            <div class="form-input">
                <select name="category_id">
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                        選択してください
                    </option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- お問い合わせ内容 -->
        <div class="form-row">
            <label>お問い合わせ内容 <span class="required">※</span></label>

            <div class="form-input">
                <textarea name="detail"
                    placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>

                @error('detail')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="btn-area">
            <button type="submit" class="confirm-btn">確認画面</button>
        </div>

    </form>
</div>

</body>
</html>
