<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminConfig;

class ConfigController extends Controller
{
    /** @var AdminConfigRepository */
    private $adminConfigModel;

    public function __construct(AdminConfig $adminConfigRepo)
    {
        $this->adminConfigModel = $adminConfigRepo;
    }
    public function index()
    {
        $data = [
            'table' => [
                'type'    => 'table',
                // 'url'     => 'api/admin/system',
                // 'method'  => 'post',
                'stripe' => true,
                'column' => [
                    [
                        'type' => 'selection',
                        'width'=> '55',
                    ],
                    [
                        'prop' => 'id',
                        'label'=> 'ID',
                        'width'=> '55',
                    ],
                    [
                        'prop' => 'name',
                        'label'=> '名称',
                    ],
                    [
                        'prop' => 'title',
                        'label'=> '标题',
                    ],
                    [
                        'prop' => 'sort',
                        'label'=> '排序',
                    ],
                    [
                        'prop' => 'status',
                        'label'=> '状态',
                        'type' => 'status',
                    ],
                    [
                        'prop' => 'rightButton',
                        'label'=> '操作',
                        'type' => 'btn',
                    ],
                ],
                'datas'   => [

                ]
            ]
        ];
        $adminConfigs = $this->adminConfigModel
                            ->where('status', '>=', 0)
                            ->get();
        $data['table']['datas'] = $adminConfigs;
        return response()->json($data, 200);
    }
}
