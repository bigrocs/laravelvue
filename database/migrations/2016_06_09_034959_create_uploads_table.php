<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateuploadsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid')           ->comment('用户ID')->unsigned();
            $table->string('name')              ->comment('文件名称');
            $table->string('path')              ->comment('文件路径');
            $table->string('url')               ->comment('文件链接');
            $table->char('extension',6)         ->comment('文件类型');
            $table->bigInteger('size')          ->comment('文件大小')->unsigned();
            $table->char('md5',32)              ->comment('文件MD5');
            $table->char('sha1',40)             ->comment('文件SHA1编码');
            $table->string('disk',15)           ->comment('文件存储位置');
            $table->bigInteger('download')      ->comment('文件下载次数')->unsigned();
            $table->tinyInteger('status')       ->comment('状态')->default(1);
            $table->bigInteger('sort')          ->comment('排序')->unsigned();
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
        Schema::drop('uploads');
    }
}
