@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="reservations">
        <h3 class="reservation-heading">予約状況</h3>
        @foreach($beforeReservations as $index => $reservation)
            <div class="reservation-content">
                <a class="reservation-link" href="{{ route('edit', ['reservation_id' => $reservation->id]) }}">
                    <div class="reservation-index">
                        <img src="{{ asset('storage/images/clock.png') }}" alt="時計">
                        <p>予約{{ $index + 1 }}</p>
                        <form class="delete-form" action="{{ route('remove', ['reservation_id' => $reservation->id]) }}" method="post">
                        @csrf
                        <input type="submit" id="delete" value="×">
                    </form>
                    </div>
                    <table class="reservation-confirm">
                    <tr>
                        <th>Shop</th>
                        <td>{{ $reservation->shop->name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $reservation->date }}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>{{ $reservation->formatted_time }}</td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td>{{ $reservation->number }}人</td>
                    </tr>
                    </table>
                </a>
            </div>
        @endforeach
        @foreach($afterReservations as $reservation)
            <div class="done-content">
                <a class="done-link" href="{{ route('review', ['reservation_id' => $reservation->id]) }}">
                    <p class="done-heading">来店済み</p>
                    <table class="reservation-confirm">
                    <tr>
                        <th>Shop</th>
                        <td>{{ $reservation->shop->name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $reservation->date }}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>{{ $reservation->formatted_time }}</td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td>{{ $reservation->number }}人</td>
                    </tr>
                    </table>
                    <p class="done-txt">レビューを書く</p>
                </a>
            </div>
        @endforeach
    </div>
    <div class="likes">
        <h2 class="myname">{{ $user->name }}<span>さん</span></h2>
        <h3 class="likes-heading">お気に入り店舗</h3>
        <div class="shops">
        @foreach($likes as $like)
            <div class="shop">
                <div class="shop-img">
                    <img src="{{ asset($like->shop->image) }}" alt="画像">
                </div>
                <div class="shop-txt">
                    <p class="shop-name">{{ $like->shop->name }}</p>
                    <p class="shop-tag">#{{ $like->shop->area->name }}</p>
                    <p class="shop-tag">#{{ $like->shop->category->content }}</p>
                </div>
                <div class="actions">
                    <a class="shop-show" href="{{ route('show', ['shop_id' => $like->shop->id]) }}">詳しく見る</a>
                    <div class="shop-like">
                        <form action="{{ $like->shop->liked() ? '/unlike/'.$like->shop->id : '/like/'.$like->shop->id  }}" method="post" class="like-form" id="like__form">
                        @csrf
                            <button><i class="fa-2xl fa-heart {{ $like->shop->liked() ? 'red-heart' : 'gray-heart' }} fa-sharp fa-solid"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection