<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminConfig;
use BuilderData;

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
        $adminConfigs = $this->adminConfigModel
                            ->where('status', '>=', 0)
                            ->get();
        $datas = BuilderData::addTableData($adminConfigs)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> '55'])
                                ->addTableColumn(['prop' => 'name',       'label'=> '名称',   'width'=> '200'])
                                ->addTableColumn(['prop' => 'title',      'label'=> '标题',   'width'=> '180'])
                                ->addTableColumn(['prop' => 'sort',       'label'=> '排序',   'width'=> '70'])
                                ->addTableColumn(['prop' => 'status',     'label'=> '状态',   'width'=> '90','type' => 'status'])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'type' => 'btn'])
                                ->addTableApiUrl('urlStatus','api/admin/config/status')   //添加状态通信API
                                ->addTableApiUrl('urlDelete','api/admin/config/delete')   //添加删除通信API
                                ->addRightButton(['type'=>'edit'])                        // 添加编辑按钮
                                ->addRightButton(['type'=>'forbid'])                      // 添加禁用/启用按钮
                                ->addRightButton(['type'=>'delete'])                      // 添加删除按钮
                                ->get();
        return response()->json($datas, 200);
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
