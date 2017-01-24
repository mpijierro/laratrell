<?php


namespace LaraTrell\Src;

use LaraTrell\Src\Wrapper\UserWrapper;

class ConfigureUser
{

    private $userWrapper = null;
    private $user;

    public function __construct(UserWrapper $userWrapper)
    {
        $this->userWrapper = $userWrapper;
        $this->configure();
    }

    public function getUser()
    {
        return $this->user;
    }

    private function configure()
    {

        $trelloIdentification = [
            'trello_id' => $this->userWrapper->getUserId(),
            'trello_username' => $this->userWrapper->username()
        ];

        $this->user = User::firstOrCreate($trelloIdentification);

    }
}