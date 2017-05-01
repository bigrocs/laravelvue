<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
        	'id'		=> 1,
            'group' 	=> 'admin',
            'pid' 		=> 0,
            'title' 	=> '首页 Dashboard',
            'type' 		=> '',
            'value'     => '/admin/dashboard',
            'api_url'    => '/api/admin/dashboard/dashboard',
            'icon' 		=> 'fa fa-dashboard',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 2,
            'group' 	=> 'admin',
            'pid' 		=> 0,
            'title' 	=> '系统 system',
            'type' 		=> 'header',
            'value'     => '',
            'api_url'    => '',
            'icon' 		=> 'fa fa-adjust',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 3,
            'group' 	=> 'admin',
            'pid' 		=> 0,
            'title' 	=> '系统功能',
            'type' 		=> '',
            'value'     => '',
            'api_url'    => '',
            'icon' 		=> 'fa fa-cog',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 4,
            'group' 	=> 'admin',
            'pid' 		=> 3,
            'title' 	=> '系统设置',
            'type' 		=> '',
            'value'     => '/admin/system/system',
            'api_url'    => '/api/admin/system/system',
            'icon' 		=> 'fa fa-wrench',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 5,
            'group' 	=> 'admin',
            'pid' 		=> 3,
            'title' 	=> '导航菜单',
            'type' 		=> '',
            'value'     => '/admin/system/menu',
            'api_url'    => '/api/admin/system/menu',
            'icon' 		=> 'fa fa-map-signs',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 6,
            'group' 	=> 'admin',
            'pid' 		=> 3,
            'title' 	=> '配置管理',
            'type' 		=> '',
            'value'     => '/admin/system/config',
            'api_url'    => '/api/admin/system/config',
            'icon' 		=> 'fa fa-cogs',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 7,
            'group' 	=> 'admin',
            'pid' 		=> 3,
            'title' 	=> '上传管理',
            'type' 		=> '',
            'value'     => '/admin/system/upload',
            'api_url'    => '/api/admin/system/upload',
            'icon' 		=> 'fa fa-upload',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 8,
            'group' 	=> 'admin',
            'pid' 		=> 0,
            'title' 	=> '应用中心',
            'type' 		=> '',
            'value'     => '',
            'api_url'    => '',
            'icon' 		=> 'fa fa-folder-open-o',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 9,
            'group' 	=> 'admin',
            'pid' 		=> 8,
            'title' 	=> '模块扩展',
            'type' 		=> '',
            'value'     => '/admin/system/model',
            'api_url'    => '/api/admin/system/model',
            'icon' 		=> 'fa fa-wrench',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 10,
            'group' 	=> 'admin',
            'pid' 		=> 8,
            'title' 	=> '插件管理',
            'type' 		=> '',
            'value'     => '/admin/system/addon',
            'api_url'    => '/api/admin/system/addon',
            'icon' 		=> 'fa fa-cogs',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 11,
            'group' 	=> 'admin',
            'pid' 		=> 8,
            'title' 	=> '主题管理',
            'type' 		=> '',
            'value'     => '/admin/system/theme',
            'api_url'    => '/api/admin/system/theme',
            'icon' 		=> 'fa fa-adjust',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 12,
            'group' 	=> 'admin',
            'pid' 		=> 0,
            'title' 	=> '系统权限',
            'type' 		=> '',
            'value'     => '',
            'api_url'    => '',
            'icon' 		=> 'fa fa-unlock-alt',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 13,
            'group' 	=> 'admin',
            'pid' 		=> 12,
            'title' 	=> '用户管理',
            'type' 		=> '',
            'value'     => '/admin/system/user',
            'api_url'    => '/api/admin/system/user',
            'icon' 		=> 'fa fa-user',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 14,
            'group' 	=> 'admin',
            'pid' 		=> 12,
            'title' 	=> '角色管理',
            'type' 		=> '',
            'value'     => '/admin/system/role',
            'api_url'    => '/api/admin/system/role',
            'icon' 		=> 'fa fa-group',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);
        DB::table('menus')->insert([
        	'id'		=> 15,
            'group' 	=> 'admin',
            'pid' 		=> 12,
            'title' 	=> '权限管理',
            'type' 		=> '',
            'value'     => '/admin/system/permission',
            'api_url'    => '/api/admin/system/permission',
            'icon' 		=> 'fa fa-unlock',
            'target' 	=> '',
            'sort' 		=> 1,
            'status' 	=> 1,
        ]);

    }
}
