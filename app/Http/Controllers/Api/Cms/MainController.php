<?php

namespace App\Http\Controllers\Api\Cms;

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
        // $data =  BuilderMain::setRoute('dashboard',        '/admin/dashboard')
        //                     ->setRoute('systemSystem',     '/admin/system/system', '/api/admin/system/system')
        //                     ->setRoute('systemConfig',     '/admin/system/config', '/api/admin/system/config')
        //                     ->setRoute('systemUpload',     '/admin/system/upload', '/api/admin/system/upload')
        //                     ->setRoute('systemModel',      '/admin/system/model',  '/api/admin/system/model')
        //                     ->setRoute('systemAddon',      '/admin/system/addon',  '/api/admin/system/addon')
        //                     ->setRoute('systemTheme',      '/admin/system/theme',  '/api/admin/system/theme')
        //                     ->setMenu('dashboard','首页 Dashboard','fa fa-dashboard')
        //                     ->setMenu('systemHeader','系统 system','fa fa-adjust','',true)
        //                     ->setMenu('systemTop','系统功能','fa fa-cog')
        //                     ->setMenu('systemSystem','系统设置','fa fa-wrench','systemTop')
        //                     ->setMenu('systemConfig','配置管理','fa fa-cogs','systemTop')
        //                     ->setMenu('systemUpload','上传管理','fa fa-upload','systemTop')
        //                     ->setMenu('systemApplication','应用中心','fa fa-folder-open-o')
        //                     ->setMenu('systemModel','模块扩展','fa fa-wrench','systemApplication')
        //                     ->setMenu('systemAddon','插件管理','fa fa-cogs','systemApplication')
        //                     ->setMenu('systemTheme','主题管理','fa fa-adjust','systemApplication')
        //                     ->setConfig('homeRouterNmae',  'dashboard')
        //                     ->setConfig('loginRouterNmae', 'login')
        $data =  BuilderMain::setApiUrl('logout',          '/logout')
                            ->setApiUrl('login',           '/login')
                            ->setApiUrl('authCheck',       '/authCheck')
                            ->get();
        return response()->json($data, 200);
    }
}
