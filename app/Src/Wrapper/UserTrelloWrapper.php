<?php

namespace LaraTrell\Src\Wrapper;

use Laravel\Socialite\Facades\Socialite;

class UserTrelloWrapper implements UserInterfaceWrapper
{
    private $user;

    public function __construct()
    {
        $this->user = Socialite::driver('trello')->user();
    }

    private function dataUser()
    {
        return $this->user->user;
    }

    public function getUser()
    {
        return $this->dataUser();
    }

    public function token()
    {
        return $this->user->token;
    }

    public function tokenSecret()
    {
        return $this->user->tokenSecret;
    }

    public function oauthToken()
    {
        return $this->user->accessTokenResponseBody['oauth_token'];
    }

    public function oauthTokenSecret()
    {
        return $this->user->accessTokenResponseBody['oauth_token_secret'];
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
}
