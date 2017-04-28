<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Facades\ {
    App\Facades\BuilderData,
    App\Facades\Helpers
};
class PermissionController extends Controller
{
	/** @var permissionPepo */
    private $permissionModel;

    public function __construct(Permission $permissionPepo)
    {
        $this->permissionModel = $permissionPepo;
    }
    public function index(Request $request)
    {
        //处理下请求数据
        list($group,$pageSizes,$pageSize,$page,$selectSearch,$inputSearch) = Helpers::compileTableRequest($request);
        // [$total 获取数据总数]
        $total = $this->permissionModel
                        ->where($selectSearch, 'like', $inputSearch)
                        ->count();
        //[$roleModel 获取数据对象]
        $permission = $this->permissionModel
                        ->page($page, $pageSize)
                        ->orderBy('id', 'ASC')
                        ->where($selectSearch, 'like', $inputSearch)
                        ->get();
        return $data = BuilderData::addTableData($permission)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> '55'])
                                ->addTableColumn(['prop' => 'name',       'label'=> '权限标识', 'minWidth'=> '120'])
                                ->addTableColumn(['prop' => 'display_name','label'=> '权限名称','minWidth'=> '180'])
                                ->addTableColumn(['prop' => 'description','label'=> '权限描述','minWidth'=> '280'])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'minWidth'=> '220',  'type' => 'btn'])
                                ->addTableTopButton(['buttonType'=>'add',   'apiUrl'=> '/api/admin/system/permission/add',    'title'=>'新增角色'])                         // 添加新增按钮
                                ->addTableTopButton(['buttonType'=>'delete','apiUrl'=> '/api/admin/system/permission/delete'])                         // 添加删除按钮
                                ->addTableRightButton(['buttonType'=>'edit','apiUrl'=> '/api/admin/system/permission/edit'])                         // 添加编辑按钮
                                ->addTableRightButton(['buttonType'=>'delete','apiUrl'=> '/api/admin/system/permission/delete'])                       // 添加删除按钮
                                ->setTablePagination(['total'=>$total,'pageSize'=>$pageSize,'pageSizes'=>$pageSizes,'layout'=>'total, sizes, prev, pager, next, jumper'])//分页设置
                                ->setSearchTitle('请输入搜索内容')
                                ->setSearchSelect(['id'=>'ID','name'=>'权限标识','display_name'=>'权限名称','description'=>'权限描述'])
                                ->setTitle('配置管理')
                                ->get();
    }
    public function add(){
        return $data = BuilderData::addFormApiUrl('submit','/api/admin/system/permission/store')               //添加Submit通信API
                            ->setFormTitle('新增权限')                                                   //添form表单页面标题
                            ->setFormConfig(['width'=>'90px'])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '权限标识'     ])
                            ->addFormItem(['name' => 'display_name','type' => 'text',     'label' => '权限名称'   ])
                            ->addFormItem(['name' => 'description','type' => 'textarea','label' => '权限描述'   ])
                            ->setFormRules($this->permissionModel->getRules())
                            ->get();
    }
    public function store(Request $request)
    {
        $permissionModel = new Permission();
        $permissionModel->name = $request->name;
        $permissionModel->display_name = $request->display_name;
        $permissionModel->description = $request->description;
        $permissionModel->save();
        $data = [
                        'title'     => '新增角色成功！',
                        'message'   => '新增角色数据成功！!',
                        'type'      => 'success',
                ];

        return response()->json($data, 200);
    }
    public function edit(Request $request){ 
        $permission = $this->permissionModel->find($request->id);
        return $data = BuilderData::addFormApiUrl('submit','/api/admin/system/permission/update')               //添加Submit通信API
                            ->setFormTitle('新增角色')                                                   //添form表单页面标题
                            ->setFormConfig(['width'=>'90px'])
                            ->addFormItem(['name' => 'id',        'type' => 'hidden',   'label' => 'ID'     ])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '角色标识'     ])
                            ->addFormItem(['name' => 'display_name','type' => 'text',     'label' => '角色名称'   ])
                            ->addFormItem(['name' => 'description','type' => 'textarea','label' => '角色描述'   ])
                            ->setFormObject($permission)
                            ->setFormRules($this->permissionModel->getRules())
                            ->get();
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $permission = $this->permissionModel->find($request->id)->fill($input)->save();
        $data = [
                        'title'     => '用户编辑成功！',
                        'message'   => '编辑用户数据成功！!',
                        'type'      => 'success',
                    ];
        return response()->json($data, 200);
    }
}
