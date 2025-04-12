@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="show">
    <div class="shop-info">
        <div class="shop-heading">
            <a class="home-link" href="#" onclick="window.history.back(); return false;">＜</a>
            <h1 class="shop-name">{{ $shop->name }}</h1>
        </div>
        <div class="shop-img">
            <img src="{{ asset($shop->image) }}" alt="画像">
        </div>
        <div class="shop-tag">
            <p class="shop-tag">#{{ $shop->area->name }}</p>
            <p class="shop-tag">#{{ $shop->category->content }}</p>
        </div>
        <p class="shop-txt">{{ $shop->description }}</p>
    </div>
    <div class="reservation">
        <form class="reservation-form" action="{{ route('store', ['shop_id' => $shop->id]) }}" method="post">
            @csrf
            <h2 class="reservation-heading">予約</h2>
            <div class="reservation-input">
                <input class="input_field" name="date" type="date" data-target="display_date" value="{{ old('date') }}">
            </div>
            <p class="error-message">
                @error('date')
                    {{ $message }}
                @enderror
            </p>
            <div class="reservation-input">
                <input class="input_field" name="time" type="time" data-target="display_time" value="{{ old('time') }}" id="time">
                <label class="select-label" for="time"><img src="{{ asset('storage/images/arrow.jpeg') }}" alt="矢印"></label>
            </div>
            <p class="error-message">
                @error('time')
                    {{ $message }}
                @enderror
            </p>
            <div class="reservation-input">
                <select class="number-select" name="number" id="number-select">
                    <option value="" hidden>選択してください</option>
                    @for ($i = 1; $i <= 30; $i++)
                        <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                </select>
                <label class="select-label" for="number-select"><img src="{{ asset('storage/images/arrow.jpeg') }}" alt="矢印"></label>
            </div>
            <p class="error-message">
                @error('number')
                    {{ $message }}
                @enderror
            </p>
            <table class="reservation-confirm">
                <tr>
                    <th>Shop</th>
                    <td>{{ $shop->name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><span id="display_date"></span></td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td><span id="display_time"></span></td>
                </tr>
                <tr>
                    <th>Number</th>
                    <td><span id="display_number"></span></td>
                </tr>
            </table>
            <div class="reserve-btn">
                <input type="submit" value="予約する">
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/show.js') }}"></script>
@endsection