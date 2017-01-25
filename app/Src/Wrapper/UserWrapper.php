<?php

namespace LaraTrell\Src\Wrapper;

use Laravel\Socialite\Facades\Socialite;

class UserWrapper
{

    private $user;

    public function __construct()
    {
        if (session()->has('trello_user')) {
            $this->user = session()->get('trello_user');
        } else {
            $this->user = Socialite::driver('trello')->user();
        }
    }

    private function dataUser()
    {

        //FIXME: Remove this conditions
        if (session()->has('trello_user')) {
            return $this->user;
        }

        return $this->user->user;
    }

    public function getUser()
    {
        return $this->dataUser();
    }

    public function token()
    {
        if (session()->has('oauth_token')) {
            return session()->get('oauth_token');
        }
        return $this->user->token;
    }

    public function tokenSecret()
    {
        return $this->user->tokenSecret;
    }

    public function nickName()
    {
        return $this->user->nickname;
    }

    public function username()
    {
        return $this->dataUser()['username'];
    }

    public function getUserId()
    {
        return $this->dataUser()['id'];
    }

    public function getIdBoards()
    {
        return $this->dataUser()['idBoards'];
    }

    public function oauthToken()
    {
        if (session()->has('oauth_token')) {
            return session()->get('oauth_token');
        }

        return $this->user->accessTokenResponseBody['oauth_token'];
    }

    public function oauthTokenSecret()
    {
        if (session()->has('oauth_token_secret')) {
            return session()->get('oauth_token_secret');
        }

        return $this->user->accessTokenResponseBody['oauth_token_secret'];
    }

}