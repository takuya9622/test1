@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('content')


<!--バリデーション確認用
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
-->




<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>

    <form class="form" action="/confirm" method="post" novalidate>
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
                @if ($errors->has('last_name') || $errors->has('first_name'))
                <div class="form__error">
                @foreach (['last_name', 'first_name'] as $field)
                @if ($errors->has($field))
                <p>{{ $errors->first($field) }}</p>
                @endif
                @endforeach
                </div>
                @endif
            </div>
            <div class="form__group-content">
                <div class="form__input--text-field">
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ $contact['last_name'] ?? old('last_name') }}">
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ $contact['first_name'] ?? old('first_name') }}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
                @error('gender')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <input type="radio" name="gender" value="男性" id="male" checked{{ (isset($contact['gender']) && $contact['gender'] == '男性') || old('gender') == '男性' ? 'checked' : '' }}>
                    <label for="male">男性</label>

                    <input type="radio" name="gender" value="女性" id="female"{{ (isset($contact['gender']) && $contact['gender'] == '女性') || old('gender') == '女性' ? 'checked' : '' }}>
                    <label for="female">女性</label>

                    <input type="radio" name="gender" value="その他" id="other"{{ (isset($contact['gender']) && $contact['gender'] == 'その他') || old('gender') == 'その他' ? 'checked' : '' }}>
                    <label for="other">その他</label>
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
                @error('email')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ $contact['email'] ?? old('email') }}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
                @if ($errors->any())
                @php
                $telErrors = collect([$errors->first('tell1'), $errors->first('tell2'), $errors->first('tell3')])
                            ->filter()
                            ->unique()
                            ->first();
                @endphp
                @if ($telErrors)
                <div class="form__error">
                    <p>{{ $telErrors }}</p>
                </div>
                @endif
                @endif
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="tel" name="tell1" placeholder="080" value="{{ $contact['tell1'] ?? old('tell1') }}">
                    <span>-</span>
                    <input type="tel" name="tell2" placeholder="1234" value="{{ $contact['tell2'] ?? old('tell2') }}">
                    <span>-</span>
                    <input type="tel" name="tell3" placeholder="5678" value="{{ $contact['tell3'] ?? old('tell3') }}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
                @error('address')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ $contact['address'] ?? old('address') }}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ $contact['building'] ?? old('building') }}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
                @error('category_id')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select name="category_id">
                        <option value="" disabled selected>選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                        {{ (isset($contact['category_id']) && $contact['category_id'] == $category->id) || old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
                @error('detail')
                <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ $contact['detail'] ?? old('detail') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection