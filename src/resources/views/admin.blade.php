
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
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
                <option value="" disabled selected>性別</option>
                <option value="" {{ request('gender') === '' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select class="search-form__item-select" name="category_id">
                <option value="" disabled selected>お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                @endforeach
            </select>

            <input class="search-form__item-date" type="date" name="date" value="{{ request('date') }}">

            <button class="search-form__button-submit" type="submit">検索</button>
            <button class="search-form__button-reset" type="button" onclick="location.href='/admin'">リセット</button>
        </form>

        <div class="search-form__button-pagination-container">
            <button class="search-form__button-export" onclick="location.href='/admin/export'">エクスポート</button>

            <div class="pagination">
                {{ $contacts->appends(request()->query())->links() }}
            </div>
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
            @endforeach
        </table>
    </div>

    @foreach($contacts as $contact)
    <div id="modal-{{ $contact->id }}" class="modal">
        <a href="#" class="modal-close">&times;</a> <!-- 閉じるボタン -->
        <table>
            <tr><th>お名前</th><td>{{ $contact->full_name }}</td></tr>
            <tr><th>性別</th><td>{{ $contact->gender }}</td></tr>
            <tr><th>メールアドレス</th><td>{{ $contact->email }}</td></tr>
            <tr><th>電話番号</th><td>{{ $contact->tell }}</td></tr>
            <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
            <tr><th>建物名</th><td>{{ $contact->building }}</td></tr>
            <tr><th>お問い合わせの種類</th><td>{{ $contact->category->content }}</td></tr>
            <tr><th>お問い合わせ内容</th><td>{{ $contact->detail }}</td></tr>
        </table>
        <form action="{{ route('admin.destroy', $contact->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-table__button-delete" onclick="return confirm('本当に削除しますか？');">削除</button>
        </form>
    </div>
    @endforeach
</div>
@endsection
