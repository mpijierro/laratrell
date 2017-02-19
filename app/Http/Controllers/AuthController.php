<?php

namespace LaraTrell\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use LaraTrell\Src\InitializeUser;
use LaraTrell\Src\Wrapper\UserTrelloWrapper;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Trello authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::with('trello')->with(['name' => 'Laratrell'])->redirect();
    }

    /**
     * Obtain the user information from Trello.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = app(UserTrelloWrapper::class);

        $initialize = app(InitializeUser::class, ['userWrapper' => $user]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
