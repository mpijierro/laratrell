<?php

namespace LaraTrell\Src;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $table = 'user';
    protected $fillable = ['trello_id', 'trello_username',];


    public function trelloId()
    {
        return $this->attributes['trello_id'];
    }

    public function username()
    {
        return $this->attributes['trello_username'];
    }

}
