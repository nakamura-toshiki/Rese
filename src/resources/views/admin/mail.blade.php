@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mail.css') }}">
@endsection

@section('content')
<div class="mail">
    @if(session('message'))
        <p class="success">{{ session('message') }}</p>
    @endif
    <h2 class="mail-heading">メール送信フォーム</h2>
    <form class="mail-form" method="post" action="{{ route('admin.send') }}">
        @csrf
        <label>件名:</label><br>
        <input type="text" name="subject" required><br><br>
        <label>本文:</label><br>
        <textarea name="body" rows="10" required></textarea><br><br>
        <div class="form-btn">
            <input type="submit" value="送信">
        </div>
    </form>
</div>
@endsection
