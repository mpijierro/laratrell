<?php

namespace LaraTrell\Src\Wrapper;

class UserSessionWrapper implements UserInterfaceWrapper
{
    private $user;

    public function __construct()
    {
        if (session()->has('trello_user')) {
            $this->user = session()->get('trello_user');
        } else {
            throw new \Exception('User not found in session');
        }
    }

    private function dataUser()
    {
        return $this->user;
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

        throw new \Exception('Oauth token not found in session');
    }

    public function tokenSecret()
    {
        return $this->user->tokenSecret;
    }

    public function oauthToken()
    {
        if (session()->has('oauth_token')) {
            return session()->get('oauth_token');
        }

        throw new \Exception('Oauth token not found in session');
    }

    public function oauthTokenSecret()
    {
        if (session()->has('oauth_token_secret')) {
            return session()->get('oauth_token_secret');
        }

        throw new \Exception('Oauth token secret not found in session');
    }

    public function nickName()
    {
        return $this->username();
    }

    public function username()
    {
        return $this->user['username'];
    }

    public function getUserId()
    {
        return $this->user['id'];
    }

    public function getIdBoards()
    {
        return $this->user['idBoards'];
    }
}
