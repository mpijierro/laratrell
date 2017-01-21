<?php

namespace LaraTrell\Src\Wrapper;

use Laravel\Socialite\Facades\Socialite;

class UserWrapper
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

    public function token()
    {
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
        return $this->nickName();
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