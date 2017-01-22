<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserList extends Migration
{
    public function up()
    {
        Schema::create('user_list', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');

            $table->string('name', 255);
            $table->string('color', 30);

        });
    }

    public function down()
    {
        Schema::drop('user_list');
    }
}
