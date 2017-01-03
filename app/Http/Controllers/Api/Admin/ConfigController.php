<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\Input;
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
                'urlStatus'     => 'api/admin/config/status',
                'urlDelete'     => 'api/admin/config/delete',
                // 'method'  => 'post',
                'stripe' => true,
                'rightButton'=>[
                    ['type'=>'edit'],
                    ['type'=>'forbid'],
                    ['type'=>'hide'],
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
    public function status(Request $request){
        foreach ($request->all() as $value) {
            $adminConfig = $this->adminConfigModel->where('id', '=', $value['id'])->update(['status' => $value['status']]);
        }
        $data = [
                    'title'     => '状态已更改',
                    'message'   => '后台配置数据状态更改成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
    public function delete(Request $request){
        foreach ($request->all() as $value) {
            $response = $this->adminConfigModel->find($value['id'])->forceDelete();
        }
        $data = [
                    'title'     => '删除成功',
                    'message'   => '后台配置数据删除成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
}
