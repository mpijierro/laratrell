<?php

namespace LaraTrell\Src;

use Illuminate\Support\Facades\Auth;
use LaraTrell\Src\Wrapper\UserTrelloWrapper;

class InitializeUser
{
    private $userWrapper = null;
    private $user;

    public function __construct(UserTrelloWrapper $userWrapper)
    {
        $this->userWrapper = $userWrapper;

        $this->saveOrCreateUser();

        $this->loginUser();

        $this->saveOauthTokenInSession();
    }

    public function getUser()
    {
        return $this->user;
    }

    private function saveOrCreateUser()
    {
        if (!Auth::check()) {
            $trelloIdentification = [
                'trello_id'       => $this->userWrapper->getUserId(),
                'trello_username' => $this->userWrapper->username(),
            ];

            $this->user = User::firstOrCreate($trelloIdentification);
        }
    }

    private function loginUser()
    {
        if (!Auth::check()) {
            Auth::loginUsingId($this->getUser()->id);
        }
    }

    private function saveOauthTokenInSession()
    {
        //FIXME: save in session user correctly. Is a array
        session(['trello_user' => $this->userWrapper->getUser()]);
        session(['oauth_token' => $this->userWrapper->oauthToken()]);
        session(['oauth_token_secret' => $this->userWrapper->oauthTokenSecret()]);
    }
}
