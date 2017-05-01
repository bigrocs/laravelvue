<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group',11)           ->comment('分组');
            $table->bigInteger('pid')            ->comment('父ID')->unsigned()->default(0);
            $table->string('title',31)           ->comment('导航标题');
            $table->string('type',15)            ->comment('导航类型');
            $table->text('value')                ->comment('导航值')->nullable();
            $table->string('api_route')            ->comment('API网址')->nullable();
            $table->string('icon',32)            ->comment('字体图标')->nullable();
            $table->string('target',11)          ->comment('打开方式')->nullable();
            $table->tinyInteger('status')        ->comment('状态')->default(1);
            $table->bigInteger('sort')           ->comment('排序')->unsigned()->default(0);
            $table->timestamps();
        });
        Schema::create('permission_menu', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('menu_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('permission_menu');
    }
}
