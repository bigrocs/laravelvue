<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function index()
    {

        $data = [
            'apiUrl' => 'dazles',
            'form' => [
                'type'    => 'form',
                'url'     => 'api/admin/system',
                'method'  => 'post',
                'datas'   => [
                    [
                        'buliderType' => 'switch',
                        'value' => '免费开源的互联网WEB产品最佳选择',
                        'disabled' => false,
                        'width' => 58,
                        'onIconClass' => '',
                        'offIconClass' => '',
                        'onText' => '开启',
                        'offText' => '关闭',
                        'onColor' => '#13ce66',
                        'offColor' => '#ff4949',
                        'tips' => '网站口号、宣传标语、一句话介绍'
                    ],[
                        'buliderType' => 'input',
                        'type' => 'text',
                        'value' => '免费开源的互联网WEB产品最佳选择',
                        'label' => '网站口号',
                        'placeholder' => '网站口号、宣传标语、一句话介绍',
                        'tips' => '网站口号、宣传标语、一句话介绍'
                    ],[
                        'buliderType' => 'upload',
                        'type' => 'text',
                        'value' => '免费开源的互联网WEB产品最佳选择',
                        'label' => '网站口号',
                        'placeholder' => '网站口号、宣传标语、一句话介绍',
                        'tips' => '网站口号、宣传标语、一句话介绍'
                    ],[
                        'buliderType' => 'input',
                        'type' => 'textarea',
                        'value' => 'BigRocs是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等开放化低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。',
                        'placeholder' => '网站搜索引擎描述',
                        'label' => '网站描述',
                        'tips' => '网站搜索引擎描述',
                        'rows' => 5
                    ],[
                        'buliderType' => 'input',
                        'type' => 'textarea',
                        'value' => 'BigRcos,laravel,vue,vue2.0,vue-router',
                        'placeholder' => '网站搜索引擎关键字',
                        'label' => '网站关键字',
                        'tips' => '网站搜索引擎关键字',
                        'rows' => 3
                    ],[
                        'buliderType' => 'input',
                        'type' => 'text',
                        'value' => 'Copyright © 博兴县鹏皓网络科技有限公司 All rights reserved.',
                        'placeholder' => '设置在网站底部显示的版权信息，如“版权所有 © 2007-2017 鹏皓网络科技”',
                        'label' => '版权信息',
                        'tips' => '设置在网站底部显示的版权信息，如“版权所有 © 2007-2017 鹏皓网络科技”'
                    ],[
                        'buliderType' => 'input',
                        'type' => 'text',
                        'value' => '鲁ICP备1272117-1号',
                        'placeholder' => '设置在网站底部显示的备案号，如“鲁ICP备1272117-1号',
                        'label' => '网站备案号',
                        'tips' => '设置在网站底部显示的备案号，如“鲁ICP备1272117-1号”'
                    ],[
                        'buliderType' => 'input',
                        'type' => 'text',
                        'value' => '',
                        'placeholder' => '支持百度、Google、cnzz等所有Javascript的统计代码',
                        'label' => '站点统计',
                        'tips' => '支持百度、Google、cnzz等所有Javascript的统计代码'
                    ]
                ]
            ]
        ];
        return response()->json($data, 200);
    }
}
