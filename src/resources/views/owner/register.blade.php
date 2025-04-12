@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
@if(empty($shop))
    <h2 class="register-heading">店舗情報登録</h2>
    <form class="register-form" action="{{ route('owner.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <div class="register-info">
                <label class="input-label">店舗画像</label>
            </div>
            <div class="register-img">
                <img class="appload-img" id="shopImage" src="" alt="選択した画像" style="display: none;">
            </div>
            <div class="select--btn">
                <label class="select-btn__label" for="target">
                    画像選択
                    <input id="target" name="image" class="select-btn__input" type="file" accept="image/png, image/jpeg">
                </label>
            </div>
            <p class="error-message">
                @error('image')
                    {{ $message }}
                @enderror
            </p>
        </div>
        <div class="txt">
            <div class="register-info">
                <label class="input-label" for="name">店舗名</label>
                <div class="input-txt">
                    <input type="text" name="name" id="name" value="{{ old('name') }} ">
                </div>
            </div>
            <p class="error-message">
                @error('name')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-info">
                <label class="input-label" for="area">エリア</label>
                <select name="area_id" id="area" class="area-select">
                    <option value="" {{ request('area_id') ? '' : 'selected' }}>選択してください</option>
                    @foreach ($areas as $area)
                        <option value="{{ old('area_id', $area->id) }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                            {{$area->name}}
                        </option>
                    @endforeach
                </select>
                <div class="select-img"><img src="{{ asset('storage/images/arrow.jpeg') }}" alt="矢印"></div>
            </div>
            <p class="error-message">
                @error('area_id')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-info">
                <label class="input-label" for="category">ジャンル</label>
                <select name="category_id" id="category" class="category-select">
                    <option value="" {{ request('category_id') ? '' : 'selected' }}>選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ old('category_id', $category->id) }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{$category->content}}
                        </option>
                    @endforeach
                </select>
                <div class="select-img" for="category"><img src="{{ asset('storage/images/arrow.jpeg') }}" alt="矢印"></div>
            </div>
            <p class="error-message">
                @error('category_id')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-info">
                <label class="input-label" for="description">店舗概要</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <p class="error-message">
                @error('description')
                    {{ $message }}
                @enderror
            </p>
        </div>
        <div class="form-btn">
            <input type="submit" value="登録する">
        </div>
    </form>
@else
    <h2 class="register-heading">店舗情報編集</h2>
    <form class="register-form" action="{{ route('owner.edit', ['shop_id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <div class="register-info">
                <label class="input-label">店舗画像</label>
            </div>
            <div class="register-img">
                <img class="appload-img" id="shopImage" src="" alt="選択した画像" style="display: none;" >
            </div>
            <div class="select-btn">
                <label class="select-btn__label">
                    画像選択
                    <input id="target" name="image" class="select-btn__input" type="file" accept="image/png, image/jpeg">
                </label>
                <p class="error-message">
                @error('image')
                    {{ $message }}
                @enderror
                </p>
            </div>
        </div>
        <div class="txt">
            <div class="register-info">
                <label class="input-label" for="name">店舗名</label>
                <div class="input-txt">
                    <input type="text" name="name" value="{{ old('name', $shop->name) }} ">
                </div>
            </div>
            <p class="error-message">
                @error('name')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-info">
                <label class="input-label" for="area">エリア</label>
                <select name="area_id" id="area" class="area-select">
                    <option value="" {{ request('area_id') ? '' : (isset($shop->area_id) ? '' : 'selected') }}>選択してください</option>
                    @foreach ($areas as $area)
                        <option value="{{ old('area_id', $area->id) }}" {{ request('area_id') == $area->id ? 'selected' : (isset($shop->area_id) && $shop->area_id == $area->id ? 'selected' : '') }}>
                            {{$area->name}}
                        </option>
                    @endforeach
                </select>
                <div class="select-img" for="area"><img src="{{ asset('storage/images/arrow.jpeg') }}" alt="矢印"></div>
            </div>
            <p class="error-message">
                @error('area_id')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-info">
                <label class="input-label" for="category">ジャンル</label>
                <select name="category_id" id="category" class="category-select">
                    <option value="" {{ request('category_id') ? '' : (isset($shop->category_id) ? '' : 'selected') }}>選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ old('category_id', $category->id) }}" {{ request('category_id') == $category->id ? 'selected' : (isset($shop->category_id) && $shop->category_id == $category->id ? 'selected' : '') }}>
                            {{$category->content}}
                        </option>
                    @endforeach
                </select>
                <div class="select-img" for="category"><img src="{{ asset('storage/images/arrow.jpeg') }}" alt="矢印"></div>
            </div>
            <p class="error-message">
                @error('category_id')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-info">
                <label class="input-label" for="description">店舗概要</label>
                <textarea name="description" id="description">{{ old('description', $shop->description) }}</textarea>
            </div>
            <p class="error-message">
                @error('description')
                    {{ $message }}
                @enderror
            </p>
        </div>
        <div class="form-btn">
            <input type="submit" value="登録する">
        </div>
    </form>
    @endif
</div>
<script>
document.getElementById('target').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const image = document.getElementById('shopImage');

    if (file && (file.type === 'image/png' || file.type === 'image/jpeg')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
            image.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        image.src = '';
        image.style.display = 'none';
    }
});
</script>
@endsection