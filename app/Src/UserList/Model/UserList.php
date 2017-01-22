<?php

namespace LaraTrell\Src\UserList\Model;

use Illuminate\Database\Eloquent\Model;
use LaraTrell\Src\User;

class UserList extends Model
{

    public $timestamps = false;

    protected $table = 'user_list';
    protected $fillable = ['user_id', 'name', 'color'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
