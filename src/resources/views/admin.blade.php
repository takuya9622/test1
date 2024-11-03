
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
<style>
/* モーダルの初期状態を非表示にする */
.modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60%;
    padding: 20px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    z-index: 10;
}

/* 背景のオーバーレイ */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9;
}

/* :targetを使ってモーダルを表示 */
.modal:target {
    display: block;
}

.modal-overlay:target {
    display: block;
}

/* 閉じるボタンのスタイル */
.modal-close {
    display: block;
    text-align: right;
    margin-bottom: 10px;
}
</style>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__header">
        <h2>Admin</h2>
    </div>

    <div class="search-form">
        <form class="search-form__item" action="/admin/search" method="get">
            <input class="search-form__input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

            <select class="search-form__item-select" name="gender">
                <option value="">性別</option>
                <option value="" {{ request('gender') === '' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select class="search-form__item-select" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                @endforeach
            </select>

            <input class="search-form__item-date" type="date" name="date" value="{{ request('date') }}">

            <button class="search-form__button-submit" type="submit">検索</button>
            <button class="search-form__button-reset" type="button" onclick="location.href='/admin'">リセット</button>
        </form>

        <div class="search-form__button">
            <button class="search-form__button-export" onclick="location.href='/admin/export'">エクスポート</button>
        </div>
    </div>

    <div class="admin-table">
        <table class="admin-table__inner">
        <tr class="admin-table__row">
            <th class="admin-table__header">お名前</th>
            <th class="admin-table__header">性別</th>
            <th class="admin-table__header">メールアドレス</th>
            <th class="admin-table__header">お問い合わせの種類</th>
            <th class="admin-table__header"></th>
        </tr>
        @foreach($contacts as $contact)
        <tr class="admin-table__row">
            <td class="admin-table__item">{{ $contact->full_name }}</td>
            <td class="admin-table__item">{{ $contact->gender }}</td>
            <td class="admin-table__item">{{ $contact->email }}</td>
            <td class="admin-table__item">{{ $contact->category->content }}</td>
            <td class="admin-table__item">
            <a class="admin-table__button" href="#modal-{{ $contact->id }}">詳細</a>
            </td>
        </tr>

         <!-- モーダルウィンドウ -->
        <div id="modal-{{ $contact->id }}" class="modal">
            <div class="modal-close">
                <a href="#">閉じる</a>
            </div>
            <p><strong>お名前:</strong> {{ $contact->full_name }}</p>
            <p><strong>性別:</strong> {{ $contact->gender }}</p>
            <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
            <p><strong>電話番号:</strong> {{ $contact->tell }}</p>
            <p><strong>住所:</strong> {{ $contact->address }}</p>
            <p><strong>建物名:</strong> {{ $contact->building }}</p>
            <p><strong>お問い合わせの種類:</strong> {{ $contact->category->content }}</p>
            <p><strong>お問い合わせ内容:</strong> {{ $contact->detail }}</p>
            <form action="{{ route('admin.destroy', $contact->id) }}" method="POST" style="margin-top: 20px;">
            @csrf
            @method('DELETE')
                <button type="submit" class="admin-table__button-delete"
                    onclick="return confirm('本当に削除しますか？');">削除</button>
            </form>
        </div>
        <div class="modal-overlay" id="overlay-{{ $contact->id }}"></div>

        @endforeach
        </table>
    </div>

    <div class="pagination">
        {{ $contacts->appends(request()->query())->links() }}
    </div>
</div>
@endsection
