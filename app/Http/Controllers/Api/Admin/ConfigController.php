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
    public function index(Request $request)
    {
        $group = $request->get('tabsId');
        $group = empty($group) ? 0 : $group;
        $adminConfigs = $this->adminConfigModel
                            ->where('group', '=', $group)
                            ->where('status', '>=', 0)
                            ->get();
        $tabs = explode(',', getAdminConfig('CONFIG_GROUP_LIST'));
        $data = BuilderData::addTableData($adminConfigs)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> '55'])
                                ->addTableColumn(['prop' => 'name',       'label'=> '名称',   'width'=> '200'])
                                ->addTableColumn(['prop' => 'title',      'label'=> '标题',   'width'=> '180'])
                                ->addTableColumn(['prop' => 'sort',       'label'=> '排序',   'width'=> '70'])
                                ->addTableColumn(['prop' => 'status',     'label'=> '状态',   'width'=> '90','type' => 'status'])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'type' => 'btn'])
                                ->addTableApiUrl('urlStatus','api/admin/config/status')         //添加状态通信API
                                ->addTableApiUrl('urlDelete','api/admin/config/delete')         //添加删除通信API
                                ->addTableApiUrl('urlAdd','api/admin/config/add')               //添加数据接口
                                ->addTableTopButton(['type'=>'addnew'])                        // 添加新增按钮
                                ->addTableTopButton(['type'=>'resume'])                        // 添加启用按钮
                                ->addTableTopButton(['type'=>'forbid'])                        // 添加禁用按钮
                                ->addTableTopButton(['type'=>'delete'])                        // 添加删除按钮
                                ->addTableRightButton(['type'=>'edit'])                        // 添加编辑按钮
                                ->addTableRightButton(['type'=>'forbid'])                      // 添加禁用/启用按钮
                                ->addTableRightButton(['type'=>'delete'])                      // 添加删除按钮
                                ->addTabs($tabs)                                          //设置页面Tabs
                                ->get();
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
    public function add(){
        $data = BuilderData::addFormApiUrl('urlSubmit','api/admin/config/update')               //添加Submit通信API
                            ->addFormTitle('新增配置')                                           //添form表单页面标题
                            ->addFormItem(['name' => 'group',     'type' => 'select',   'label' => '配置分组',     'placeholder' => '配置所属的分组',    ])
                            ->addFormItem(['name' => 'type',      'type' => 'select',   'label' => '配置类型',     'placeholder' => '配置类型的分组',    ])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '配置名称',     'placeholder' => '配置名称'])
                            ->addFormItem(['name' => 'title',     'type' => 'text',     'label' => '配置标题',     'placeholder' => '配置标题'])
                            ->addFormItem(['name' => 'value',     'type' => 'textarea', 'label' => '配置值',       'placeholder' => '配置值'                                  ,'rows'=>4])
                            ->addFormItem(['name' => 'options',   'type' => 'textarea', 'label' => '配置项',       'placeholder' => '如果是单选、多选、下拉等类型 需要配置该项'  ,'rows'=>4])
                            ->addFormItem(['name' => 'tip',       'type' => 'textarea', 'label' => '配置说明',     'placeholder' => '配置说明'                                ,'rows'=>4])
                            ->addFormItem(['name' => 'sort',      'type' => 'num',      'label' => '排序',         'placeholder' => '用于显示的顺序'])
                            ->get();
        return response()->json($data, 200);
    }
}
