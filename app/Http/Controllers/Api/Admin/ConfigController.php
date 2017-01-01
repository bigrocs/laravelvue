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
                'rightButton'=>[
                    ['type'=>'edit'],
                    ['type'=>'forbid'],
                    ['type'=>'delete'],
                ],
                'column' => [
                    [
                        'prop' => 'id',
                        'label'=> 'ID',
                        'width'=> '55',
                    ],
                    [
                        'prop' => 'name',
                        'label'=> '名称',
                        'width'=> '200',
                    ],
                    [
                        'prop' => 'title',
                        'label'=> '标题',
                        'width'=> '180',
                    ],
                    [
                        'prop' => 'sort',
                        'label'=> '排序',
                        'width'=> '70',
                    ],
                    [
                        'prop' => 'status',
                        'label'=> '状态',
                        'type' => 'status',
                        'width'=> '90',
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
