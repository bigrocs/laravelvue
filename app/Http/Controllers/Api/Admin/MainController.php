<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Facades\ {
    App\Facades\BuilderMain
};
class MainController extends Controller
{
    public function index()
    {
        $data = [
            'routes'  => [
                [
                    'name'  => 'dashboard',
                    'title' =>  '首页 Dashboard',
                    'path'  =>  '/admin/dashboard',
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
                    'path'  =>  '/admin/system',
                    'icon'  =>  'fa fa-wrench',
                    'parent'=>  'system_top',
                    'apiUrl'=> '/api/admin/system'
                ],
                [
                    'name'  => 'system_config',
                    'title' =>  '配置管理',
                    'path'  =>  '/admin/config',
                    'icon'  =>  'fa fa-cogs',
                    'parent'=>  'system_top',
                    'apiUrl'=> '/api/admin/config'
                ],
                [
                    'name'  => 'system_upload',
                    'title' =>  '上传管理',
                    'path'  =>  '/admin/upload',
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
                    'path'  =>  '/admin/model',
                    'icon'  =>  'fa fa-wrench',
                    'parent'=>  'system_application',
                    'apiUrl'=> '/api/admin/model'
                ],
                [
                    'name'  => 'system_addon',
                    'title' =>  '插件管理',
                    'path'  =>  '/admin/addon',
                    'icon'  =>  'fa fa-cogs',
                    'parent'=>  'system_application',
                    'apiUrl'=> '/api/admin/addon'
                ],
                [
                    'name'  => 'system_theme',
                    'title' =>  '主题管理',
                    'path'  =>  '/admin/theme',
                    'icon'  =>  'fa fa-adjust',
                    'parent'=>  'system_application',
                    'apiUrl'=> '/api/admin/theme'
                ],
            ],
            'apiUrl'  =>[
                'logout'    => '/admin/logout',
                'login'     => '/admin/login',
                'authCheck' => '/admin/authCheck' //认证检测
            ],
            'config'  =>[
                'homeRouterNmae'    => 'dashboard',
                'loginRouterNmae'    => 'login'
            ]

        ];
        $data =  BuilderMain::setRoute('dashboard',        '/admin/dashboard')
                            ->setRoute('systemSystem',     '/admin/system/system', '/api/admin/system/system')
                            ->setRoute('systemConfig',     '/admin/system/config', '/api/admin/system/config')
                            ->setRoute('systemUpload',     '/admin/system/upload', '/api/admin/system/upload')
                            ->setRoute('systemModel',      '/admin/system/model',  '/api/admin/system/model')
                            ->setRoute('systemAddon',      '/admin/system/addon',  '/api/admin/system/addon')
                            ->setRoute('systemTheme',      '/admin/system/theme',  '/api/admin/system/theme')
                            ->setMenu('dashboard','首页 Dashboard','fa fa-dashboard')
                            ->setMenu('systemHeader','系统 system','fa fa-adjust','',true)
                            ->setMenu('systemTop','系统功能','fa fa-cog')
                            ->setMenu('systemSystem','系统设置','fa fa-wrench','systemTop')
                            ->setMenu('systemConfig','配置管理','fa fa-cogs','systemTop')
                            ->setMenu('systemUpload','上传管理','fa fa-upload','systemTop')
                            ->setMenu('systemApplication','应用中心','fa fa-folder-open-o')
                            ->setMenu('systemModel','模块扩展','fa fa-wrench','systemApplication')
                            ->setMenu('systemAddon','插件管理','fa fa-cogs','systemApplication')
                            ->setMenu('systemTheme','主题管理','fa fa-adjust','systemApplication')
                            ->setConfig('homeRouterNmae',  'dashboard')
                            ->setConfig('loginRouterNmae', 'login')
                            ->setApiUrl('logout',          '/admin/logout')
                            ->setApiUrl('login',           '/admin/login')
                            ->setApiUrl('authCheck',       '/admin/authCheck')
                            ->get();
        return response()->json($data, 200);
    }
}
