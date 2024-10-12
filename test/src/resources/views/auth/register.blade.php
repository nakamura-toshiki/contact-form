@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('button')
<nav>
    <ul class="header-nav">
        <li class="header-nav__button">
            <a class="header-nav__link" href="/login">login</a>
        </li>
    </ul>
</nav>
@endsection

@section('content')
<main>
    <div class="register-form__content">
        <div class="register-form__heading">
            <h2>Register</h2>
        </div>
        <form class="form" action="/register" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    お名前
                </div>
                <div class="form__input--text">
                    <input type="text" name="name" placeholder="例:山田　太郎" value="{{ old('name') }}">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    メールアドレス
                </div>
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}">
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    パスワード
                </div>
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="例:coachtech1106">
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit">登録</button>
            </div>
        </form>
    </div>
</main>
@endsection