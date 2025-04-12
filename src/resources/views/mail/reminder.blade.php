<p>{{ $reservation->user->name }} 様</p>
<p>本日 {{ $reservation->formatted_time }} に {{ $reservation->shop->name }} へのご予約があります。</p>
<p>ご来店時に以下のQRコードを提示してください。</p>
{!! QrCode::generate(route('read', ['reservation_id' => $reservation->id])); !!}
<p>ご来店をお待ちしております</p>