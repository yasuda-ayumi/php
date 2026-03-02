@extends('layouts.app')

@section('content')

<div class="container">

    <!-- ヘッダー -->
    <header class="header">
        <h1>FashionablyLate</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">logout</button>
        </form>
    </header>

    <div class="header-line"></div>

    <h2 class="admin-title">Admin</h2>

    <div class="content-wrapper">

        <!-- 検索フォーム -->
        <form method="GET" class="search-area">

            <input type="text" name="keyword"
                placeholder="名前やメールアドレスを入力してください"
                value="{{ request('keyword') }}">

            <select name="gender">
                <option value="">性別</option>
                <option value="all">全て</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>

            <select name="category_id">
                <option value="">お問い合わせの種類</option>
                <option value="all">全て</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->content }}</option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ request('date') }}">

            <button class="search-btn">検索</button>
            <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>

        </form>

        <!-- ★追加：検索ボタン下にページネーション -->
        <div class="pagination-wrapper">
            {{ $contacts->onEachSide(1)->links('vendor.pagination.default') }}
        </div>

        <!-- エクスポート -->
        <a href="{{ route('admin.export', request()->query()) }}" class="export-btn">
            エクスポート
        </a>

        <!-- テーブル -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <button class="detail-btn"
                            data-id="{{ $contact->id }}"
                            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                            data-gender="{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}"
                            data-email="{{ $contact->email }}"
                            data-tel="{{ $contact->tel1 }}{{ $contact->tel2 }}{{ $contact->tel3 }}"
                            data-address="{{ $contact->address }}"
                            data-building="{{ $contact->building }}"
                            data-category="{{ $contact->category->content }}"
                            data-detail="{{ $contact->detail }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- モーダル -->
<div class="modal">
    <div class="modal-content">

        <span id="close">×</span>

        

        <div class="modal-row">
            <strong>お名前</strong>
            <span id="modal-name"></span>
        </div>

        <div class="modal-row">
            <strong>性別</strong>
            <span id="modal-gender"></span>
        </div>

        <div class="modal-row">
            <strong>メールアドレス</strong>
            <span id="modal-email"></span>
        </div>

        <div class="modal-row">
            <strong>電話番号</strong>
            <span id="modal-tel"></span>
        </div>

        <div class="modal-row">
            <strong>住所</strong>
            <span id="modal-address"></span>
        </div>

        <div class="modal-row">
            <strong>建物名</strong>
            <span id="modal-building"></span>
        </div>

        <div class="modal-row">
            <strong>お問い合わせの種類</strong>
            <span id="modal-category"></span>
        </div>

        <div class="modal-row">
            <strong>お問い合わせ内容</strong>
            <span id="modal-detail"></span>
        </div>

        <form id="delete-form" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-btn">
        削除
    </button>
</form>

    </div>
</div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.querySelector('.modal');
    const detailButtons = document.querySelectorAll('.detail-btn');
    const closeBtn = document.getElementById('close');

    detailButtons.forEach(button => {
        button.addEventListener('click', function () {

            document.getElementById('modal-name').textContent = this.dataset.name;
            document.getElementById('modal-gender').textContent = this.dataset.gender;
            document.getElementById('modal-email').textContent = this.dataset.email;
            document.getElementById('modal-tel').textContent = this.dataset.tel;
            document.getElementById('modal-address').textContent = this.dataset.address;
            document.getElementById('modal-building').textContent = this.dataset.building;
            document.getElementById('modal-category').textContent = this.dataset.category;
            document.getElementById('modal-detail').textContent = this.dataset.detail;

            const id = this.dataset.id;
            document.getElementById('delete-form').action = '/admin/' + id;

            modal.style.display = 'flex';
        });
    });

    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

});
</script>
@endsection