@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done">
    <p class="done-message">ご予約ありがとうございます</p>
    <div class="back">
        <a class="back-link" href="/">戻る</a>
    </div>
</div>
@endsection