@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review">
    <h2 class="review-title">レビューを書く</h2>
    <p class="shop-name">{{ $reservation->shop->name }}</p>
    <div class="review-content">
        <form class="review-form" action="{{ route('post', ['reservation_id' => $reservation->id]) }}" method="post">
            @csrf
            <div class="score">
                <input type="radio" name="score" id="radio1" value="1">
                <label class="score-label" for="radio1">1</label>
                <input type="radio" name="score" id="radio2" value="2">
                <label class="score-label" for="radio2">2</label>
                <input type="radio" name="score" id="radio3" value="3">
                <label class="score-label" for="radio3">3</label>
                <input type="radio" name="score" id="radio4" value="4">
                <label class="score-label" for="radio4">4</label>
                <input type="radio" name="score" id="radio5" value="5">
                <label class="score-label" for="radio5">5</label>
            </div>
            <div class="score-rule">
                <p>bad</p>
                <p>good</p>
            </div>
            <div class="comment">
                <h3 class="comment-heading">コメント</h3>
                <textarea name="comment"></textarea>
            </div>
            <div class="review-form__btn">
                <input type="submit" value="送信する">
            </div>
        </form>
    </div>
</div>
@endsection