@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done">
    <p class="done-message">登録しました</p>
    <div class="back">
        <a class="back-link" href="{{ route('admin') }}">戻る</a>
    </div>
</div>
@endsection