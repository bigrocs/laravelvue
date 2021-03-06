<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminConfig;
use Facades\ {
    App\Facades\BuilderData,
    App\Facades\Helpers
};

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
        //处理下请求数据
        list($group,$pageSizes,$pageSize,$page,$selectSearch,$inputSearch) = Helpers::compileTableRequest($request);
        // [$total 获取数据总数]
        $total = $this->adminConfigModel
                            ->where('group', '=', $group)
                            ->where('status', '>=', 0)
                            ->where($selectSearch, 'like', $inputSearch)
                            ->count();

        // [$adminConfigs 获取数据对象]
        $adminConfigs = $this->adminConfigModel
                            ->page($page, $pageSize)
                            ->orderBy('sort', 'ASC')
                            ->where('group', '=', $group)
                            ->where('status', '>=', 0)
                            ->where($selectSearch, 'like', $inputSearch)
                            ->get();
        return $data = BuilderData::addTableData($adminConfigs)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> '55'])
                                ->addTableColumn(['prop' => 'name',       'label'=> '名称',   'minWidth'=> '240'])
                                ->addTableColumn(['prop' => 'title',      'label'=> '标题',   'minWidth'=> '180'])
                                ->addTableColumn(['prop' => 'sort',       'label'=> '排序',   'width'=> '70'])
                                ->addTableColumn(['prop' => 'status',     'label'=> '状态',   'minWidth'=> '90','type' => 'status'])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'minWidth'=> '220','type' => 'btn'])
                                ->addTableTopButton(['buttonType'=>'add',       'apiUrl'=> route('api.admin.system.config.add'),'title'=>'添加配置'])                         // 添加新增按钮
                                ->addTableTopButton(['buttonType'=>'resume',    'apiUrl'=> route('api.admin.system.config.status')])                         // 添加启用按钮
                                ->addTableTopButton(['buttonType'=>'forbid',    'apiUrl'=> route('api.admin.system.config.status')])                         // 添加禁用按钮
                                ->addTableTopButton(['buttonType'=>'delete',    'apiUrl'=> route('api.admin.system.config.delete')])                         // 添加删除按钮
                                ->addTableRightButton(['buttonType'=>'edit',    'apiUrl'=> route('api.admin.system.config.edit')])                         // 添加编辑按钮
                                ->addTableRightButton(['buttonType'=>'forbid',  'apiUrl'=> route('api.admin.system.config.status')])                       // 添加禁用/启用按钮
                                ->addTableRightButton(['buttonType'=>'delete',  'apiUrl'=> route('api.admin.system.config.delete')])                       // 添加删除按钮
                                ->setTabs(Helpers::getTabsConfigGroupList())                                                //设置页面Tabs
                                ->setTablePagination(['total'=>$total,'pageSize'=>$pageSize,'pageSizes'=>$pageSizes,'layout'=>'total, sizes, prev, pager, next, jumper'])//分页设置
                                ->setSearchTitle('请输入搜索内容')
                                ->setSearchSelect(['id'=>'ID','name'=>'名称','title'=>'标题'])
                                ->setTitle('配置管理')
                                ->get();
    }
    public function status(Request $request){
        $input = $request->all();
        foreach ($input as $id => $value) {
            $adminConfig = $this->adminConfigModel->where('id', '=', $id)->update(['status' => $value]);
        }
        $data = [
                    'title'     => '状态已更改',
                    'message'   => '后台配置数据状态更改成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
    public function delete(Request $request){
        $input = $request->all();
        foreach ($input as $id => $value) {
            $response = $this->adminConfigModel->find($id)->forceDelete();
        }
        $data = [
                    'title'     => '删除成功',
                    'message'   => '后台配置数据删除成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
    public function add(){
        $configGroupList = Helpers::getTabsConfigGroupList();
        $formItemType = BuilderData::getformItemType();
        return $data = BuilderData::addFormApiUrl('submit',route('api.admin.system.config.store'))               //添加Submit通信API
                            ->setFormTitle('新增配置')                                           //添form表单页面标题
                            ->addFormItem(['name' => 'group',     'type' => 'select',   'label' => '配置分组',     'placeholder' => '配置所属的分组',                          'options'=>$configGroupList,    'value'=>0])
                            ->addFormItem(['name' => 'type',      'type' => 'select',   'label' => '配置类型',     'placeholder' => '配置类型的分组',                          'options'=>$formItemType,       'value'=>'text'])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '配置名称',     'placeholder' => '配置名称'])
                            ->addFormItem(['name' => 'title',     'type' => 'text',     'label' => '配置标题',     'placeholder' => '配置标题'])
                            ->addFormItem(['name' => 'value',     'type' => 'textarea', 'label' => '配置值',       'placeholder' => '配置值',                                   'rows'=>4])
                            ->addFormItem(['name' => 'options',   'type' => 'textarea', 'label' => '配置项',       'placeholder' => '如果是单选、多选、下拉等类型 需要配置该项',   'rows'=>4])
                            ->addFormItem(['name' => 'tip',       'type' => 'textarea', 'label' => '配置说明',     'placeholder' => '配置说明',                                  'rows'=>4])
                            ->addFormItem(['name' => 'sort',      'type' => 'number',   'label' => '排序',         'placeholder' => '用于显示的顺序'                             ,'value'=>0])
                            ->get();
    }
    /**
     * [store 新增配置数据].
     *
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-07-16T14:44:59+0800
     *
     * @param Request $request [请求数据]
     *
     * @return [type] [description]
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $response = $this->adminConfigModel->create($input);
        if ($response->wasRecentlyCreated) {
            $data = [
                        'title'     => '新增数据成功！',
                        'message'   => '新增配置数据成功！!',
                        'type'      => 'success',
                    ];
        }else{
            $data = [
                        'title'     => '新增数据失败！',
                        'message'   => '新增配置数据失败！!',
                        'type'      => 'error',
                    ];
        }
        return response()->json($data, 200);
    }
    public function edit(Request $request){
        $adminConfig = $this->adminConfigModel->find($request->id);
        $configGroupList = Helpers::getTabsConfigGroupList();
        $formItemType = BuilderData::getformItemType();
        return $data = BuilderData::addFormApiUrl('submit',route('api.admin.system.config.update'))              //添加Submit通信API
                            ->setFormTitle('编辑配置')                                           //添form表单页面标题
                            ->addFormItem(['name' => 'id',        'type' => 'text',     'label' => '数据ID',       'placeholder' => 'ID','disabled'=>true])
                            ->addFormItem(['name' => 'group',     'type' => 'select',   'label' => '配置分组',     'placeholder' => '配置所属的分组','options'=>$configGroupList])
                            ->addFormItem(['name' => 'type',      'type' => 'select',   'label' => '配置类型',     'placeholder' => '配置类型的分组','options'=>$formItemType])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '配置名称',     'placeholder' => '配置名称'])
                            ->addFormItem(['name' => 'title',     'type' => 'text',     'label' => '配置标题',     'placeholder' => '配置标题'])
                            ->addFormItem(['name' => 'value',     'type' => 'textarea', 'label' => '配置值',       'placeholder' => '配置值',                                   'rows'=>4])
                            ->addFormItem(['name' => 'options',   'type' => 'textarea', 'label' => '配置项',       'placeholder' => '如果是单选、多选、下拉等类型 需要配置该项',   'rows'=>4])
                            ->addFormItem(['name' => 'tip',       'type' => 'textarea', 'label' => '配置说明',     'placeholder' => '配置说明',                                  'rows'=>4])
                            ->addFormItem(['name' => 'sort',      'type' => 'number',   'label' => '排序',         'placeholder' => '用于显示的顺序'])
                            ->setFormObject($adminConfig)
                            ->get();
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $response = $this->adminConfigModel->find($input['id'])->fill($input)->save();
        if ($response) {
            $data = [
                        'title'     => '数据编辑成功！',
                        'message'   => '编辑配置数据成功！!',
                        'type'      => 'success',
                    ];
        }else{
            $data = [
                        'title'     => '数据编辑失败！',
                        'message'   => '编辑配置数据失败！!',
                        'type'      => 'error',
                    ];
        }
        return response()->json($data, 200);
    }
}
