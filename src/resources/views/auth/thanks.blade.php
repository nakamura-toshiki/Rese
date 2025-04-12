@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done">
    <p class="done-message">会員登録ありがとうございます</p>
    <div class="login">
        <a class="login-link" href="{{ route('verification.notice') }}">ログインする</a>
    </div>
</div>
@endsection