@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="list">
    <h2 class="list-heading">予約一覧</h2>
    <div class="list-month">
        <div class="previous">
            <a class="previous-link" href="?date={{ $previousDay }}"><span class="previous-arrow">➔</span>前日</a>
        </div>
        <div class="current">
            <img class="current-img" src="{{ asset('storage/images/calendar.png') }}" alt="カレンダー">
            <span class="current-date">{{ $current->isoFormat('YYYY/MM/DD') }}</span>
        </div>
        <div class="next">
            <a class="next-link" href="?date={{ $nextDay }}">翌日<span class="next-arrow">➔</span></a>
        </div>
    </div>
    <table class="list-content">
        <tr class="list-content__columns">
            <th class="list-content__column">名前</th>
            <th class="list-content__column">時間</th>
            <th class="list-content__column">人数</th>
            <th class="list-content__column-check">来店済</th>
        </tr>
        @foreach($reservations as $reservation)
            <tr class="list-content__row {{ $reservation->status === 'after' ? 'after-status' : '' }}">
                <td class="list-content__record">{{ $reservation->user->name }}</td>
                <td class="list-content__record">{{ $reservation->formatted_time }}</td>
                <td class="list-content__record">{{ $reservation->number }}人</td>
                <td class="list-content__record-check">
                    <form action="{{ $reservation->status === 'after' ? '/owner/list/uncheck/'.$reservation->id : '/owner/list/check/'.$reservation->id}}"
                            method="post" class="check-form">
                        @csrf
                        <button type="submit" class="check-btn {{ $reservation->status === 'after' ? 'checked' : '' }}">
                            <span class="icon {{ $reservation->status === 'after' ? 'checked' : '' }}">{{ $reservation->status === 'after' ? '✔' : '□' }}</span>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection