@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
<div class="login-container">
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}" class="login-form"  novalidate>
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" placeholder="例: test@example.com" required autofocus>
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
        <button type="submit" class="login-button">ログイン</button>
    </form>
</div>
@endsection