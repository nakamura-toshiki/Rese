<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;

class CustomRegisteredUserController
{
    public function store(
        Request $request,
        CreateNewUser $creator
    ) {
        event(new Registered($user = $creator->create($request->all())));

        session()->put('unauthenticated_user', $user);

        return redirect()->route('thanks');
    }
}
