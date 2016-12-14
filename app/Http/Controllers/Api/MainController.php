<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        $data = [
            'routes'  => [
                'system_header'=>[
                    'name'  =>  '系统 system',
                    'icon'  =>  '',
                    'header'=>  true,
                ],
                'system_top'=>[
                    'name'  =>  '系统功能',
                    'icon'  =>  'fa fa-cog',
                ],
                'system_system'=>[
                    'name'  =>  '系统设置',
                    'path'  =>  '/system',
                    'icon'  =>  'fa fa-wrench',
                    'parent'   =>  'system_top',
                    'apiUrl'=> ''
                ],
                'system_config'=>[
                    'name'  =>  '配置管理',
                    'path'  =>  '/config',
                    'icon'  =>  'fa fa-cogs',
                    'parent'   =>  'system_top',
                    'apiUrl'=> ''
                ],
                'system_upload'=>[
                    'name'  =>  '上传管理',
                    'path'  =>  '/upload',
                    'icon'  =>  'fa fa-upload',
                    'parent'   =>  'system_top',
                    'apiUrl'=> ''
                ],
            ],
            'apiUrl'  =>[

            ]
        ];
        return response()->json($data, 200);
    }
}
