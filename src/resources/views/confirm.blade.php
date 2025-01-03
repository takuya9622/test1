@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')



<div class="confirm-container">
    <div>
        <h1>Confirm</h1>
    </div>
    <table class="confirm-table">
        <tr>
            <th class="confirm-table__top">お名前</th>
            <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ $contact['gender'] }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $contact['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $contact['tell1'] }}-{{ $contact['tell2'] }}-{{ $contact['tell3'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $contact['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $contact['building'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>{{ $contact['category_content'] }}</td>
        </tr>
        <tr>
            <th class="confirm-table__bottom">お問い合わせ内容</th>
            <td>{{ $contact['detail'] }}</td>
        </tr>
    </table>

    <div class="form-buttons">
        <form action="/thanks" method="post">
            @csrf
            <button type="submit" class="send-button">送信</button>
        </form>
        <form action="/" method="get">
            @csrf
            @foreach($contact as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="edit-button">修正</button>
        </form>
    </div>
</div>
@endsection