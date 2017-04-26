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
        return $data =  BuilderMain::setRoute('dashboard', '/admin/dashboard',            '/api/admin/system/dashboard')
                            ->setRoute('systemSystem',     '/admin/system/system',        '/api/admin/system/system')
                            ->setRoute('systemConfig',     '/admin/system/config',        '/api/admin/system/config')
                            ->setRoute('systemUpload',     '/admin/system/upload',        '/api/admin/system/upload')
                            ->setRoute('systemModel',      '/admin/system/model',         '/api/admin/system/model')
                            ->setRoute('systemAddon',      '/admin/system/addon',         '/api/admin/system/addon')
                            ->setRoute('systemTheme',      '/admin/system/theme',         '/api/admin/system/theme')
                            ->setRoute('systemUser',       '/admin/system/user',          '/api/admin/system/user')
                            ->setRoute('systemRole',       '/admin/system/role',          '/api/admin/system/role')
                            ->setRoute('systemPermission', '/admin/system/permission',    '/api/admin/system/permission')
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
                            ->setMenu('systemAuthority','系统权限','fa fa-unlock-alt')
                            ->setMenu('systemUser','用户管理','fa fa-user','systemAuthority')
                            ->setMenu('systemRole','角色管理','fa fa-group','systemAuthority')
                            ->setMenu('systemPermission','权限管理','fa fa-unlock','systemAuthority')
                            ->setConfig('homeRouterNmae',  'dashboard')
                            ->setConfig('loginRouterNmae', 'login')
                            ->setApiUrl('logout',          '/admin/logout')
                            ->setApiUrl('login',           '/admin/login')
                            ->setApiUrl('authCheck',       '/admin/authCheck')
                            ->get();
    }
}
