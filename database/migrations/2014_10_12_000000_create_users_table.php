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
            $table->increments('id')            ->comment('用户ID');
            $table->string('name')              ->comment('用户名');
            $table->string('email')->unique();
            $table->bigInteger('mobile')        ->comment('用户手机')->unsigned();
            $table->string('password')          ->comment('用户密码');
            $table->rememberToken()             ->comment('记住用户令牌');
            $table->tinyInteger('status')       ->comment('状态')->default(1);
            $table->timestamps();
        });
        Schema::create('user_infos', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('avatar')           ->comment('用户头像')->unsigned()->default(1);
            $table->integer('integral')         ->comment('用户积分')->unsigned()->default(0);
            $table->decimal('money',11, 2)      ->comment('用户余额')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_infos');
    }
}
