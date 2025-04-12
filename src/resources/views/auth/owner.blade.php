@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth">
    <form class="auth-form" action="/owner/login" method="post">
        @csrf
        <p class="auth-form__heading">OwnerLogin</p>
        <div class="auth-form__content">
            <div class="auth-form__input">
                <label class="auth-form__label" for="email">
                    <img class="auth-form__img" src="{{ asset('storage/images/email.jpeg') }}" alt="メール">
                </label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <p class="error-message">
                @error('email')
                    {{$message}}
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
                    {{$message}}
                @enderror
            </p>
            @if (!$errors->has('email') && !$errors->has('password'))
                <p class="error-message">
                    @error('login_error')
                        {{$message}}
                    @enderror
                </p>
            @endif
            <div class="form-button">
                <input type="submit" value="ログイン">
            </div>
        </div>
    </form>
</div>
@endsection