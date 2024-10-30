@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>

    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text-field">
                    <input type="text" name="first_name" placeholder="例: 山田" value="{{ old('first_name') }}">
                    <input type="text" name="last_name" placeholder="例: 太郎" value="{{ old('last_name') }}">
                </div>
                @error('first_name')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <input type="radio" name="gender" value="男性" id="male" {{ old('gender') == '男性' ? 'checked' : '' }}>
                    <label for="male">男性</label>
                    <input type="radio" name="gender" value="女性" id="female" {{ old('gender') == '女性' ? 'checked' : '' }}>
                    <label for="female">女性</label>
                    <input type="radio" name="gender" value="その他" id="other" {{ old('gender') == 'その他' ? 'checked' : '' }}>
                    <label for="other">その他</label>
                </div>
                @error('gender')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                @error('email')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                    <span>-</span>
                    <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                    <span>-</span>
                    <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                </div>
                @error('tel')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
                @error('address')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select name="category">
                        <option value="" disabled selected>選択してください</option>
                        <option value="商品のお届けについて" {{ old('category') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="商品の交換について" {{ old('category') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="商品トラブル" {{ old('category') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="ショップへのお問い合わせ" {{ old('category') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="その他" {{ old('category') == 'その他' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                @error('category')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
                </div>
                @error('content')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection