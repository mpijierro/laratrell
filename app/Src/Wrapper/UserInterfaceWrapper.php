<?php

namespace LaraTrell\Src\Wrapper;


interface UserInterfaceWrapper
{

    public function getUser();

    public function token();

    public function tokenSecret();

    public function oauthToken();

    public function oauthTokenSecret();

    public function nickName();

    public function username();

    public function getUserId();

    public function getIdBoards();

}