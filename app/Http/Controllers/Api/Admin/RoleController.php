<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Facades\ {
    App\Facades\BuilderData,
    App\Facades\Helpers
};
class RoleController extends Controller
{
	/** @var rolePepo */
    private $roleModel;

    public function __construct(Role $rolePepo)
    {
        $this->roleModel = $rolePepo;
    }
    public function index(Request $request)
    {
        //处理下请求数据
        list($group,$pageSizes,$pageSize,$page,$selectSearch,$inputSearch) = Helpers::compileTableRequest($request);
        // [$total 获取数据总数]
        $total = $this->roleModel
                        ->where($selectSearch, 'like', $inputSearch)
                        ->count();
        //[$roleModel 获取数据对象]
        $roles = $this->roleModel
                        ->page($page, $pageSize)
                        ->orderBy('id', 'ASC')
                        ->where($selectSearch, 'like', $inputSearch)
                        ->get();
    
        return $data = BuilderData::addTableData($roles)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> '55'])
                                ->addTableColumn(['prop' => 'name',       'label'=> '角色标识', 'minWidth'=> '120'])
                                ->addTableColumn(['prop' => 'display_name','label'=> '角色名称','minWidth'=> '180'])
                                ->addTableColumn(['prop' => 'description','label'=> '角色描述','minWidth'=> '280'])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'minWidth'=> '220',  'type' => 'btn'])
                                ->addTableTopButton(['buttonType'=>'add',       'apiUrl'=> route('api.admin.system.role.add'),    'title'=>'新增角色'])                         // 添加新增按钮
                                ->addTableTopButton(['buttonType'=>'delete',    'apiUrl'=> route('api.admin.system.role.delete')])                         // 添加删除按钮
                                ->addTableRightButton(['buttonType'=>'edit',    'apiUrl'=> route('api.admin.system.role.edit')])                         // 添加编辑按钮
                                ->addTableRightButton(['title'=>'权限管理',     'apiUrl'=> route('api.admin.system.role.permission'),'type'=>'warning', 'icon'=>'fa fa-unlock'])                         // 添加权限管理按钮
                                ->addTableRightButton(['buttonType'=>'delete',  'apiUrl'=> route('api.admin.system.role.delete')])                       // 添加删除按钮
                                ->setTablePagination(['total'=>$total,'pageSize'=>$pageSize,'pageSizes'=>$pageSizes,'layout'=>'total, sizes, prev, pager, next, jumper'])//分页设置
                                ->setSearchTitle('请输入搜索内容')
                                ->setSearchSelect(['id'=>'ID','name'=>'角色标识','display_name'=>'角色名称','description'=>'角色描述'])
                                ->setTitle('配置管理')
                                ->get();
    }
    public function delete(Request $request){
        $input = $request->all();
        foreach ($input as $id => $value) {
            $response = $this->roleModel->find($id)->forceDelete();
        }
        $data = [
                    'title'     => '删除成功',
                    'message'   => '角色数据删除成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
    public function add(){
        return $data = BuilderData::addFormApiUrl('submit',route('api.admin.system.role.store'))               //添加Submit通信API
                            ->setFormTitle('新增角色')                                                   //添form表单页面标题
                            ->setFormConfig(['width'=>'90px'])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '角色标识'     ])
                            ->addFormItem(['name' => 'display_name','type' => 'text',     'label' => '角色名称'   ])
                            ->addFormItem(['name' => 'description','type' => 'textarea','label' => '角色描述'   ])
                            ->setFormRules($this->roleModel->getRules())
                            ->get();
    }
    public function store(Request $request)
    {
        $roleModel = new Role();
        $roleModel->name = $request->name;
        $roleModel->display_name = $request->display_name;
        $roleModel->description = $request->description;
        $roleModel->save();
        $data = [
                        'title'     => '新增角色成功！',
                        'message'   => '新增角色数据成功！!',
                        'type'      => 'success',
                ];

        return response()->json($data, 200);
    }
    public function edit(Request $request){ 
        $roles = $this->roleModel->find($request->id);
        return $data = BuilderData::addFormApiUrl('submit',route('api.admin.system.role.update'))               //添加Submit通信API
                            ->setFormTitle('新增角色')                                                   //添form表单页面标题
                            ->setFormConfig(['width'=>'90px'])
                            ->addFormItem(['name' => 'id',        'type' => 'hidden',   'label' => 'ID'     ])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '角色标识'     ])
                            ->addFormItem(['name' => 'display_name','type' => 'text',     'label' => '角色名称'   ])
                            ->addFormItem(['name' => 'description','type' => 'textarea','label' => '角色描述'   ])
                            ->setFormObject($roles)
                            ->setFormRules($this->roleModel->getRules())
                            ->get();
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $role = $this->roleModel->find($request->id)->fill($input)->save();
        $data = [
                        'title'     => '用户编辑成功！',
                        'message'   => '编辑用户数据成功！!',
                        'type'      => 'success',
                    ];
        return response()->json($data, 200);
    }
    public function permission(Request $request){ 
        $roles = $this->roleModel->find($request->id);
        return $data = BuilderData::addFormApiUrl('submit',route('api.admin.system.role.permission-update'))               //添加Submit通信API
                            ->setFormTitle('新增角色')                                                   //添form表单页面标题
                            ->setFormConfig(['width'=>'90px'])
                            ->addFormItem(['name' => 'id',        'type' => 'hidden',   'label' => 'ID'     ])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '角色标识'     ])
                            ->addFormItem(['name' => 'display_name','type' => 'text',     'label' => '角色名称'   ])
                            ->addFormItem(['name' => 'description','type' => 'textarea','label' => '角色描述'   ])
                            ->setFormObject($roles)
                            ->setFormRules($this->roleModel->getRules())
                            ->get();
    }
    public function permissionUpdate(Request $request)
    {
        $input = $request->all();
        $role = $this->roleModel->find($request->id)->fill($input)->save();
        $data = [
                        'title'     => '用户编辑成功！',
                        'message'   => '编辑用户数据成功！!',
                        'type'      => 'success',
                    ];
        return response()->json($data, 200);
    }
}
