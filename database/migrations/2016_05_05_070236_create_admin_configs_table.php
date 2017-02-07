<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminConfigsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')         ->comment('配置标题');
            $table->string('name')          ->comment('配置名称');
            $table->text('value')           ->comment('配置值')->nullable();
            $table->tinyInteger('group')    ->comment('配置分组')->unsigned();
            $table->string('type')          ->comment('配置类型');
            $table->string('icon')          ->comment('配置字体图标')->nullable();
            $table->string('property')      ->comment('配置属性')->nullable();
            $table->string('options')       ->comment('配置额外值')->nullable();
            $table->string('tip')           ->comment('配置说明')->nullable();
            $table->tinyInteger('status')   ->comment('状态')->default(1);
            $table->bigInteger('sort')      ->comment('排序')->unsigned()->default(0);
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
        Schema::drop('admin_configs');
    }
}
