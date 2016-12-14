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
                    'apiUrl'=> ''
                ],
                [
                    'name'  => 'system_config',
                    'title' =>  '配置管理',
                    'path'  =>  '/config',
                    'icon'  =>  'fa fa-cogs',
                    'parent'=>  'system_top',
                    'apiUrl'=> ''
                ],
                [
                    'name'  => 'system_upload',
                    'title' =>  '上传管理',
                    'path'  =>  '/upload',
                    'icon'  =>  'fa fa-upload',
                    'parent'=>  'system_top',
                    'apiUrl'=> ''
                ],
            ],
            'apiUrl'  =>[

            ]
        ];
        return response()->json($data, 200);
    }
}
