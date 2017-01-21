<?php

namespace LaraTrell\Http\Controllers;

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
        return Socialite::with('trello')->redirect();
    }

    /**
     * Obtain the user information from Trello
     *
     * @return Response
     */
    public function handleProviderCallback()
    {

        $user = Socialite::driver('trello')->user();

        dd($user);

        // $user->token;
    }
}