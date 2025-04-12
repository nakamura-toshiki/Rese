@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="register">
    <a class="register-link" href="{{ route('owner.register') }}">＋</a>
    新規店舗登録
</div>
@if($shops)
    <div class="all-shops">
        @foreach($shops as $shop)
            <div class="shop">
                <div class="shop-img">
                    <img src="{{ asset($shop->image) }}" alt="画像">
                </div>
                <div class="shop-txt">
                    <p class="shop-name">{{ $shop->name }}</p>
                    <p class="shop-tag">#{{ $shop->area->name }}</p>
                    <p class="shop-tag">#{{ $shop->category->content }}</p>
                </div>
                <div class="actions">
                    <a class="shop-show" href="{{ route('owner.detail', ['shop_id' => $shop->id]) }}">編集</a>
                    <a class="shop-show" href="{{ route('owner.list', ['shop_id' => $shop->id]) }}">予約</a>
                    <a class="shop-show" href="{{ route('owner.review', ['shop_id' => $shop->id]) }}">レビュー</a>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection