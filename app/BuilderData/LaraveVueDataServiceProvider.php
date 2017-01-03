<?php

namespace App\BuilderData;

use Illuminate\Support\ServiceProvider;
class LaraveVueDataServiceProvider extends ServiceProvider
{


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBuilderData();
    }
    /**
     * [registerBuilderData 注册数据构造]
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-07-05T16:54:28+0800
     * @return   [type]                   [description]
     */
    protected function registerBuilderData()
    {
        $this->app->singleton('BuilderData', function () {
            return new BuilderData;
        });
    }
}
