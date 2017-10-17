<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();//用户名唯一
            $table->string('email')->unique();//用户邮箱唯一
            $table->string('nickname');//用户昵称
            $table->string('password');
            $table->string('website');
            $table->string('qq');
            $table->string('weixin');
            $table->string('pic');
            $table->integer('level')->default(1);
            $table->char('status')->default('1');
            $table->integer('comments')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
