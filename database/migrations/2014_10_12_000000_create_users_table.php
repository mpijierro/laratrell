<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trello_id')->unique();
            $table->string('trello_username')->unique();
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::drop('user');
    }
}
