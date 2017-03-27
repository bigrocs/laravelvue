<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' 	            => 'admin',
            'display_name' 	    => '超级管理员',
            'description' 	    => '网站超级管理员,具有最高权限'
        ]);
        DB::table('roles')->insert([
            'name'              => 'user',
            'display_name'      => '普通用户',
            'description'       => '注册后普通用户'
        ]);
        DB::table('roles')->insert([
            'name'              => 'disableUser',
            'display_name'      => '禁用用户',
            'description'       => '关到小黑屋里面的用户,没有任何权限。'
        ]);
    }
}
