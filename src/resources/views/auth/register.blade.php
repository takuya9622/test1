@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
<div>
    <div class="logo-container">
        <h1>Register</h1>
    </div>
    <div class="login-container">
        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <div class="form-group">
                <label for="name">お名前</label>
                <input id="name" type="text" name="name" placeholder="例: 山田　太郎" required autofocus>
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" placeholder="例: test@example.com" required>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" placeholder="例: coachtech1106" required>
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="login-button">登録</button>
        </form>
    </div>
</div>
@endsection
