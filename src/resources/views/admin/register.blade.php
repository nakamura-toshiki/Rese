@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<h2 class="heading">店舗代表者登録</h2>
<div class="auth">
    <form class="auth-form" action="{{ route('admin.register') }}" method="post">
        @csrf
        <p class="auth-form__heading">Registration</p>
        <div class="auth-form__content">
            <div class="auth-form__input">
                <label class="auth-form__label" for="name">
                    <img class="auth-form__img" src="{{ asset('storage/images/user.jpeg') }}" alt="人">
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Ownername">
            </div>
            <p class="error-message">
                @error('name')
                    {{ $message }}
                @enderror
            </p>
            <div class="auth-form__input">
                <label class="auth-form__label" for="email">
                    <img class="auth-form__img" src="{{ asset('storage/images/email.jpeg') }}" alt="メール">
                </label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <p class="error-message">
                @error('email')
                    {{ $message }}
                @enderror
            </p>
            <div class="auth-form__input">
                <label class="auth-form__label" for="password">
                    <img class="auth-form__img" src="{{ asset('storage/images/key.jpeg') }}" alt="鍵">
                </label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <p class="error-message">
                @error('password')
                    {{ $message }}
                @enderror
            </p>
            <div class="form-button">
                <input type="submit" value="登録">
            </div>
        </div>
    </form>
</div>
@endsection