<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\User;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\Like;
use App\Models\Review;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::get();
        $categories = Category::get();

        $query = Shop::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->input('area_id'));
        }
        
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $shops = $query->get();

        return view('index', compact('areas', 'categories', 'shops'));
    }

    public function show($shop_id)
    {
        $shop = Shop::find($shop_id);

        return view('show', compact('shop'));
    }

    public function store(ReserveRequest $request, $shop_id)
    {
        $user_id = auth()->id();
        
        Reservation::create([
            'user_id' => $user_id,
            'shop_id' => $shop_id,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number' => $request->input('number'),
        ]);

        return redirect('/done');
    }

    public function reserved()
    {
        return view('done');
    }

    public function showMypage()
    {
        $user = auth()->user();

        $reservations = Reservation::where('user_id', $user->id)->get();

        $beforeReservations = $reservations->filter(function ($reservation) {
            return $reservation->status === 'before';
        });
        $afterReservations = $reservations->filter(function ($reservation) {
            return $reservation->status === 'after';
        });


        $likes = Like::where('user_id', $user->id)->get();

        return view('mypage', compact('user', 'beforeReservations', 'afterReservations', 'likes'));
    }

    public function remove(Request $request, $reservation_id)
    {
        Reservation::find($reservation_id)->delete();

        return redirect()->back();
    }

    public function edit($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);

        $shop = $reservation->shop;

        return view('edit', compact('reservation', 'shop'));
    }

    public function update(Request $request, $reservation_id)
    {
        $reservation = Reservation::find($reservation_id);

        $reservation->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number' => $request->input('number'),
        ]);

        return redirect()->route('mypage');
    }

    public function review($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        
        return view('review', compact('reservation'));
    }

    public function postReview(Request $request, $reservation_id)
    {
        Review::create([
            'reservation_id' => $reservation_id,
            'score' => $request->input('score'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('mypage');
    }

    public function readQR($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);

        if (!$reservation) {
            return view('error');
        }

        $reservation->update(['status' => 'after']);

        return view('read');
    }
}