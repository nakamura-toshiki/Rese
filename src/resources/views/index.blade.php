@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
<div class="search-box">
    <form class="search-form" action="{{ route('index') }}" method="get">
        @csrf
        <select name="area_id" id="area" class="area-select">
            <option value="" {{ request('area_id') ? '' : 'selected' }}>All area</option>
            @foreach ($areas as $area)
                <option value="{{$area->id}}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                    {{$area->name}}
                </option>
            @endforeach
        </select>
        <label class="select-label"for="area"><img src="{{ asset('storage/images/arrow.jpeg') }}" alt="矢印"></label>
        <select name="category_id" id="category" class="category-select">
            <option value="" {{ request('category_id') ? '' : 'selected' }}>All genre</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{$category->content}}
                </option>
            @endforeach
        </select>
        <label class="select-label" for="category"><img src="{{ asset('storage/images/arrow.jpeg') }}" alt="矢印"></label>
        <div class="search-input">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
            <input class="keyword" type="text" name="name" value="{{ request('name') }}" placeholder="Search …">
        </div>
    </form>
</div>
@endsection

@section('content')
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
                <a class="shop-show" href="{{ route('show', ['shop_id' => $shop->id]) }}">詳しく見る</a>
                <div class="shop-like">
                    <form action="{{ $shop->liked() ? '/unlike/'.$shop->id : '/like/'.$shop->id  }}" method="post" class="like-form" id="like__form">
                    @csrf
                        <button><i class="fa-2xl fa-heart {{ $shop->liked() ? 'red-heart' : 'gray-heart' }} fa-sharp fa-solid"></i></button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection