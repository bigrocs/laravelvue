<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' 	            => 'admin.dashboard',
            'display_name' 	    => '后台首页',
            'description' 	    => '后台首页仪表盘'
        ]);
        DB::table('permissions')->insert([
            'name'              => 'admin.system.system',
            'display_name'      => '系统设置',
            'description'       => '系统设置权限'
        ]);
        DB::table('permissions')->insert([
            'name'              => 'admin.system.config',
            'display_name'      => '配置管理',
            'description'       => '配置管理权限。'
        ]);
        DB::table('permissions')->insert([
            'name'              => 'admin.system.upload',
            'display_name'      => '上传管理',
            'description'       => '上传管理权限。'
        ]);
        DB::table('permissions')->insert([
            'name'              => 'admin.system.user',
            'display_name'      => '用户管理',
            'description'       => '用户管理权限。'
        ]);
        DB::table('permissions')->insert([
            'name'              => 'admin.system.role',
            'display_name'      => '角色管理',
            'description'       => '角色管理权限。'
        ]);
        DB::table('permissions')->insert([
            'name'              => 'admin.system.permission',
            'display_name'      => '权限管理',
            'description'       => '权限管理权限。'
        ]);
        // DB::table('permission')->insert([
        //     'user_id'            => 1,
        //     'role_id'            => 1,
        // ]);
    }
}
