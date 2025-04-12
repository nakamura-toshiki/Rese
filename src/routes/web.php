<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\CustomRegisteredUserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StripeController;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShopController::class, 'index'])->name('index');
Route::get('/detail/{shop_id}', [ShopController::class, 'show'])->name('show');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('email');
Route::post('/register', [CustomRegisteredUserController::class, 'store'])->name('register');

Route::get('/thanks', function(){
    return view('auth.thanks');
})->name('thanks');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    session()->get('unauthenticated_user')->sendEmailVerificationNotification();
    session()->put('resent', true);
    return back()->with('message', 'Verification link sent!');
})->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    session()->forget('unauthenticated_user');
    return redirect('/');
})->name('verification.verify');

Route::middleware(['auth','verified'])->group(function (){
    Route::post('/like/{shop_id}', [LikeController::class, 'create']);
    Route::post('/unlike/{shop_id}', [LikeController::class, 'destroy']);
    Route::post('/detail/{shop_id}', [ShopController::class, 'store'])->name('store');
    Route::get('/done', [ShopController::class, 'reserved']);
    Route::get('/mypage', [ShopController::class, 'showMypage'])->name('mypage');
    Route::post('/mypage/{reservation_id}', [ShopController::class, 'remove'])->name('remove');
    Route::get('/mypage/edit/{reservation_id}', [ShopController::class, 'edit'])->name('edit');
    Route::post('/mypage/edit/{reservation_id}', [ShopController::class, 'update'])->name('update');
    Route::get('/review/{reservation_id}', [ShopController::class, 'review'])->name('review');
    Route::post('/review/{reservation_id}', [ShopController::class, 'postReview'])->name('post');
});

Route::get('/owner/login', [OwnerController::class, 'showLoginForm'])->name('owner.login');
Route::post('/owner/login', [OwnerController::class, 'login']);

Route::middleware(['auth:owner'])->group(function(){
    Route::get('/owner/index', [OwnerController::class, 'shop'])->name('owner.shop');
    Route::get('/owner/register', [OwnerController::class, 'registerShop'])->name('owner.register');
    Route::post('/owner/register', [OwnerController::class, 'store'])->name('owner.store');
    Route::get('/owner/edit/{shop_id}', [OwnerController::class, 'shopDetail'])->name('owner.detail');
    Route::post('/owner/edit/{shop_id}', [OwnerController::class, 'shopEdit'])->name('owner.edit');
    Route::get('/owner/list/{shop_id}', [OwnerController::class, 'list'])->name('owner.list');
    Route::post('/owner/list/check/{reservation_id}', [OwnerController::class, 'check']);
    Route::post('/owner/list/uncheck/{reservation_id}', [OwnerController::class, 'uncheck']);
    Route::get('/owner/review/{shop_id}', [OwnerController::class, 'review'])->name('owner.review');
    Route::get('/owner/payment', [StripeController::class, 'showForm'])->name('payment');
    Route::post('/owner/payment', [StripeController::class, 'checkout'])->name('checkout');
});

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware(['auth:admin'])->group(function(){
    Route::get('/admin/register', [AdminController::class, 'admin'])->name('admin');
    Route::post('/admin/register', [AdminController::class,'register'])->name('admin.register');
    Route::get('/admin/done', [AdminController::class, 'done'])->name('admin.done');
    Route::get('/admin/mail', [AdminController::class, 'mail'])->name('admin.mail');
    Route::post('/admin/mail', [AdminController::class, 'sendMail'])->name('admin.send');
});

Route::get('/read/{reservation_id}', [ShopController::class, 'readQR'])->name('read');