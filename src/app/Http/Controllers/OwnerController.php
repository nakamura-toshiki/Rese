<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\Review;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ShopRequest;
use Carbon\Carbon;

class OwnerController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.owner');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('owner')->attempt($credentials)) {
            return redirect()->route('owner.shop');
        }
    }

    public function shop()
    {
        $user_id = auth()->id();

        $shops = Shop::where('user_id', $user_id)->get();

        if(!$shops){
            return view('owner.index');
        }else{
            return view('owner.index', compact('shops'));
        }
    }

    public function registerShop()
    {
        $areas = Area::get();
        $categories = Category::get();

        return view('owner.register', compact('areas', 'categories'));
    }

    public function store(ShopRequest $request)
    {
        $user_id = auth()->id();

        $dir = 'images';

        $file_name = $request->file('image')->getClientOriginalName();
        Storage::disk('public')->putFileAs('images', $request->file('image'), $file_name);

        Shop::create([
            'user_id' => $user_id,
            'name' => $request->input('name'),
            'area_id' => $request->input('area_id'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'image' => 'storage/images/' . $file_name,
        ]);

        return redirect()->route('owner.shop');
    }

    public function shopDetail($shop_id)
    {
        $areas = Area::get();
        $categories = Category::get();
        $shop = Shop::find($shop_id);

        return view('owner.register', compact('areas', 'categories', 'shop'));
    }

    public function shopEdit(ShopRequest $request, $shop_id)
    {
        $user_id = auth()->id();
        $shop = Shop::find($shop_id);

        $file_name = $request->file('image')->getClientOriginalName();
        Storage::disk('public')->putFileAs('images', $request->file('image'), $file_name);

        $shop->update([
            'user_id' => $user_id,
            'name' => $request->input('name'),
            'area_id' => $request->input('area_id'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'image' => 'storage/images/' . $file_name,
        ]);

        return redirect()->route('owner.shop');
    }

    public function list(Request $request, $shop_id)
    {
        $currentDate = $request->query('date', Carbon::now()->format('Y-m-d'));

        $current = Carbon::createFromFormat('Y-m-d', $currentDate);

        $previousDay = $current->copy()->subDay()->format('Y-m-d');
        $nextDay = $current->copy()->addDay()->format('Y-m-d');

        $reservations = Reservation::whereDate('date', $currentDate)
                                    ->where('shop_id', $shop_id)->get();

        return view('owner.list', compact('current', 'previousDay', 'nextDay', 'reservations'));
    }

    public function check($reservation_id, Request $request){
        $reservation = Reservation::find($reservation_id);
        $reservation->update([
            'status' => 'after'
        ]);
        return back();
    }

    public function uncheck($reservation_id, Request $request){
        $reservation = Reservation::find($reservation_id);
        $reservation->update([
            'status' => 'before'
        ]);
        return back();
    }

    public function review($shop_id)
    {
        $reservations = Reservation::where('shop_id', $shop_id)->get();

        return view('owner.review', compact('reservations'));
    }
}
