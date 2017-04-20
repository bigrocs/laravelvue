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
                        ->where('status', '>=', 0)
                        ->where($selectSearch, 'like', $inputSearch)
                        ->count();
        //[$userModel 获取数据对象]
        $roles = $this->roleModel
                        ->page($page, $pageSize)
                        ->orderBy('id', 'ASC')
                        ->where('status', '>=', 0)
                        ->where($selectSearch, 'like', $inputSearch)
                        ->get();
    
       return $data = BuilderData::addTableData($roles)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> 55])
                                ->addTableColumn(['prop' => 'name',       'label'=> '角色名', 'minWidth'=> 120])
                                ->addTableColumn(['prop' => 'display_name','label'=> '角色名称','minWidth'=> 180])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'minWidth'=> 220,  'type' => 'btn'])
                                ->addTableApiUrl('delete','/api/admin/system/role/delete')         //添加删除通信API
                                ->addTableApiUrl('add','/api/admin/system/role/add')               //添加数据接口
                                ->addTableApiUrl('edit','/api/admin/system/role/edit')             //添加数据接口
                                ->addTableTopButton(['type'=>'add','property'=>['title'=>'新增角色','icon'=>'fa fa-plus','class'=>'success',]])                         // 添加新增按钮
                                ->addTableTopButton(['type'=>'delete'])                         // 添加删除按钮
                                ->addTableRightButton(['type'=>'edit'])                         // 添加编辑按钮
                                ->addTableRightButton(['type'=>'delete'])                       // 添加删除按钮
                                ->setTablePagination(['total'=>$total,'pageSize'=>$pageSize,'pageSizes'=>$pageSizes,'layout'=>'total, sizes, prev, pager, next, jumper'])//分页设置
                                ->setSearchTitle('请输入搜索内容')
                                ->setSearchSelect(['id'=>'ID','name'=>'用户名','email'=>'邮箱','mobile'=>'手机'])
                                ->setTitle('配置管理')
                                ->get();
    }
}
