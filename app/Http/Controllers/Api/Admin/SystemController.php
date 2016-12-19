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
            'routes'  => [
                [
                    'name'  => 'dashboard',
                    'title' =>  '首页 Dashboard',
                    'path'  =>  '/',
                    'icon'  =>  'fa fa-dashboard',
                ],
                [
                    'name'  => 'system_header',
                    'title' =>  '系统 system',
                    'icon'  =>  '',
                    'header'=>  true,
                ],
                [
                    'name'  => 'system_top',
                    'title' =>  '系统功能',
                    'icon'  =>  'fa fa-cog',
                ],
                [
                    'name'  => 'system_system',
                    'title' =>  '系统设置',
                    'path'  =>  '/system',
                    'icon'  =>  'fa fa-wrench',
                    'parent'=>  'system_top',
                    'apiUrl'=> '/api/admin/system'
                ],
                [
                    'name'  => 'system_config',
                    'title' =>  '配置管理',
                    'path'  =>  '/config',
                    'icon'  =>  'fa fa-cogs',
                    'parent'=>  'system_top',
                    'apiUrl'=> '/api/admin/config'
                ],
                [
                    'name'  => 'system_upload',
                    'title' =>  '上传管理',
                    'path'  =>  '/upload',
                    'icon'  =>  'fa fa-upload',
                    'parent'=>  'system_top',
                    'apiUrl'=> '/api/admin/upload'
                ],
                [
                    'name'  => 'system_application',
                    'title' =>  '应用中心',
                    'icon'  =>  'fa fa-folder-open-o',
                ],
                [
                    'name'  => 'system_model',
                    'title' =>  '模块扩展',
                    'path'  =>  '/model',
                    'icon'  =>  'fa fa-wrench',
                    'parent'=>  'system_application',
                    'apiUrl'=> '/api/admin/model'
                ],
                [
                    'name'  => 'system_addon',
                    'title' =>  '插件管理',
                    'path'  =>  '/addon',
                    'icon'  =>  'fa fa-cogs',
                    'parent'=>  'system_application',
                    'apiUrl'=> '/api/admin/addon'
                ],
                [
                    'name'  => 'system_theme',
                    'title' =>  '主题管理',
                    'path'  =>  '/theme',
                    'icon'  =>  'fa fa-adjust',
                    'parent'=>  'system_application',
                    'apiUrl'=> '/api/admin/theme'
                ],
            ],
            'apiUrl'  =>'456'
        ];
        return response()->json($data, 200);
    }
}
