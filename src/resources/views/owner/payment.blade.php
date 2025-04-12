@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="payment">
    @if(request('success'))
        <p style="color: green;">支払いが完了しました！</p>
    @elseif(request('canceled'))
        <p style="color: red;">支払いがキャンセルされました。</p>
    @endif
    <form class="checkout-form"action="{{ route('checkout') }}" method="POST">
        @csrf
        <div class="form-input">
            <label>支払金額（円）:</label>
            <input type="number" name="amount" required min="1">
        </div>
        <div class="form-btn">
            <input type="submit" value="支払い画面へ">
        </div>
    </form>
</div>
@endsection