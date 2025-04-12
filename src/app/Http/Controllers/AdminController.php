<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AdminRequest;
use App\Mail\NoticeMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin');
        }
    }

    public function admin()
    {
        return view('admin.register');
    }

    public function register(AdminRequest $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'owner',
        ]);

        return redirect()->route('admin.done');
    }

    public function done()
    {
        return view('admin.done');
    }

    public function mail()
    {
        return view('admin.mail');
    }

    public function sendMail(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NoticeMail($request->subject, $request->body));
        }

        return redirect()->back()->with('message', 'メールを送信しました');
    }
}
