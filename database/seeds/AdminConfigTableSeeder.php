<?php

use Illuminate\Database\Seeder;

class AdminConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_configs')->insert([
            'title' 	=> '站点开关',
            'name' 		=> 'TOGGLE_WEB_SITE',
            'value' 	=> 1,
            'group' 	=> '0',
            'type' 		=> 'switch',
            'icon' 		=> '',
            'options' 	=> '',
            'placeholder' 		=> '站点关闭后将不能访问',
            'sort' 		=> '1',
            'status' 	=> '1',
        ]);
        DB::table('admin_configs')->insert([
            'title' 	=> '网站标题',
            'name' 		=> 'WEB_SITE_TITLE',
            'value' 	=> 'BigRocs',
            'group' 	=> '0',
            'type' 		=> 'text',
            'icon' 		=> '',
            'options' 	=> '',
            'placeholder' 		=> '网站标题前台显示标题',
            'sort' 		=> '2',
            'status' 	=> '1',
        ]);
        DB::table('admin_configs')->insert([
            'title' 	=> '网站口号',
            'name' 		=> 'WEB_SITE_SLOGAN',
            'value' 	=> '免费开源的互联网WEB产品最佳选择',
            'group' 	=> '0',
            'type' 		=> 'text',
            'icon' 		=> '',
            'options' 	=> '',
            'placeholder' 		=> '网站口号、宣传标语、一句话介绍',
            'sort' 		=> '3',
            'status' 	=> '1',
        ]);
        DB::table('admin_configs')->insert([
            'title' 	=> '网站LOGO',
            'name' 		=> 'WEB_SITE_LOGO',
            'value' 	=> '',
            'group' 	=> '0',
            'type' 		=> 'picture',
            'icon' 		=> '',
            'options' 	=> '',
            'placeholder' 		=> '设置网站LOGO',
            'sort' 		=> '4',
            'status' 	=> '1',
        ]);
        DB::table('admin_configs')->insert([
            'title' 	=> '网站描述',
            'name' 		=> 'WEB_SITE_DESCRIPTION',
            'value' 	=> 'BigRocs是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等开放化低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。',
            'group' 	=> '0',
            'type' 		=> 'textarea',
            'icon' 		=> '',
            'options' 	=> '',
            'placeholder' 		=> '网站搜索引擎描述',
            'sort' 		=> '5',
            'status' 	=> '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '网站关键字',
            'name'      => 'WEB_SITE_KEYWORD',
            'value'     => 'BigRcos,laravel',
            'group' 	=> '0',
            'type'      => 'textarea',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '网站搜索引擎关键字',
            'sort'      => '6   ',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '版权信息',
            'name'      => 'WEB_SITE_COPYRIGHT',
            'value'     => 'Copyright © 博兴县鹏皓网络科技有限公司 All rights reserved.',
            'group' 	=> '0',
            'type'      => 'text',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '设置在网站底部显示的版权信息，如“版权所有 © 2007-2017 鹏皓网络科技”',
            'sort'      => '7',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '网站备案号',
            'name'      => 'WEB_SITE_ICP',
            'value'     => '鲁ICP备1272117-1号',
            'group' 	=> '0',
            'type'      => 'text',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '设置在网站底部显示的备案号，如“鲁ICP备1272117-1号”',
            'sort'      => '8',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '站点统计',
            'name'      => 'WEB_SITE_STATISTICS',
            'value'     => '',
            'group' 	=> '0',
            'type'      => 'textarea',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '支持百度、Google、cnzz等所有Javascript的统计代码',
            'sort'      => '9',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '文件上传大小',
            'name'      => 'UPLOAD_FILE_SIZE',
            'value'     => '10',
            'group' 	=> '1',
            'type'      => 'number',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '文件上传大小单位：MB',
            'sort'      => '1',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '图片上传大小',
            'name'      => 'UPLOAD_IMAGE_SIZE',
            'value'     => '2',
            'group' 	=> '1',
            'type'      => 'number',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '图片上传大小单位：MB',
            'sort'      => '2',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '分页数量',
            'name'      => 'ADMIN_PAGE_SIZE',
            'value'     => '1',
            'group' 	=> '1',
            'type'      => 'select',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '分页时每页的记录数',
            'sort'      => '3',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '分页数量选择',
            'name'      => 'ADMIN_PAGE_SIZES',
            'value'     => '5,10,20,40,80,100,200',
            'group' 	=> '1',
            'type'      => 'tags',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '分页时每页的记录数分组选择器',
            'sort'      => '4',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '导航分组',
            'name'      => 'MENU_GROUP_LIST',
            'value'     => 'admin:后台导航,main:主导航,top:顶部导航,bottom:底部导航',
            'group'     => '1',
            'type'      => 'tags',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '导航分组',
            'sort'      => '5',
            'status'    => '1',
        ]);
        DB::table('admin_configs')->insert([
            'title'     => '配置分组',
            'name'      => 'CONFIG_GROUP_LIST',
            'value'     => '基本,系统',
            'group' 	=> '1',
            'type'      => 'tags',
            'icon'      => '',
            'options'   => '',
            'placeholder'       => '配置分组',
            'sort'      => '5',
            'status'    => '1',
        ]);

    }
}
