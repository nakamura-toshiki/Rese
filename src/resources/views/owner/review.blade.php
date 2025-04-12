@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="review">
    <h2 class="review-heading">レビュー一覧</h2>
    <table class="list-content">
        <tr class="list-content__columns">
            <th class="review-list__column">名前</th>
            <th class="review-list__column">日付</th>
            <th class="review-list__column">評価</th>
            <th class="review-list__last-column">コメント</th>
        </tr>
        @foreach($reservations as $reservation)
            <tr class="list-content__row">
                <td class="review-list__record">{{ $reservation->user->name }}</td>
                <td class="review-list__record">{{ $reservation->date }}</td>
                <td class="review-list__record">
                    {{ $reservation->review ? $reservation->review->score : '' }}
                </td>
                <td class="review-list__last-record">
                    {{ $reservation->review ? $reservation->review->comment : '' }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection