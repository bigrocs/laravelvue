<?php

namespace App\BuilderData;

use Illuminate\Support\Facades\Facade;

/**
 * @see App\Builder\FormBuilder
 */
class BuilderDataFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    /**
     * @Author   BigRocs                  <BigRocs@qq.com>
     * @DateTime 2016-05-12T11:27:17+0800
     * @return   注册门面
     */
    protected static function getFacadeAccessor()
    {
        return 'BuilderData';
    }
}
