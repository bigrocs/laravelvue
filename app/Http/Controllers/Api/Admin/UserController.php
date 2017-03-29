<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Models\User;
use Facades\ {
    App\Facades\BuilderData,
    App\Facades\Helpers
};

class UserController extends Controller
{
	/** @var userRepo */
    private $userModel;

    public function __construct(User $userRepo)
    {
        $this->userModel = $userRepo;
    }
    public function index(Request $request)
    {
        //处理下请求数据
        list($group,$pageSizes,$pageSize,$page,$selectSearch,$inputSearch) = Helpers::compileTableRequest($request);
        // [$total 获取数据总数]
        $total = $this->userModel
                        ->where('status', '>=', 0)
                        ->where($selectSearch, 'like', $inputSearch)
                        ->count();
        //[$userModel 获取数据对象]
        $users = $this->userModel
                        ->page($page, $pageSize)
                        ->orderBy('id', 'ASC')
                        ->where('status', '>=', 0)
                        ->where($selectSearch, 'like', $inputSearch)
                        ->with('roles')
                        ->get();

        $users->load('roles');//加载关联数据

        $rolesTags = ['type'=>'primary',    'valueName'=>'display_name'];   // rolesTags  tags显示配置      valueName显示数据对象名称 如果不填写默认显示整个对象
        $data = BuilderData::addTableData($users)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> '55'])
                                ->addTableColumn(['prop' => 'picture',    'label'=> '头像',   'width'=> '100'])
                                ->addTableColumn(['prop' => 'roles',      'label'=> '角色',   'width'=> '120',    'type' => 'tags',    'tags'=>$rolesTags])
                                ->addTableColumn(['prop' => 'name',       'label'=> '用户名', 'width'=> '120'])
                                ->addTableColumn(['prop' => 'email',      'label'=> '邮箱',   'width'=> '180'])
                                ->addTableColumn(['prop' => 'mobile',     'label'=> '手机',   'width'=> '180'])
                                ->addTableColumn(['prop' => 'status',     'label'=> '状态',   'width'=> '90',     'type' => 'status'])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'type' => 'btn'])
                                ->addTableApiUrl('urlStatus','/api/admin/system/user/status')         //添加状态通信API
                                ->addTableApiUrl('urlDelete','/api/admin/system/user/delete')         //添加删除通信API
                                ->addTableApiUrl('urlAdd','/api/admin/system/user/add')               //添加数据接口
                                ->addTableApiUrl('urlEdit','/api/admin/system/user/edit')             //添加数据接口
                                ->addTableTopButton(['type'=>'add','property'=>['title'=>'新增用户','icon'=>'fa fa-plus','class'=>'success',]])                         // 添加新增按钮
                                ->addTableTopButton(['type'=>'resume'])                         // 添加启用按钮
                                ->addTableTopButton(['type'=>'forbid'])                         // 添加禁用按钮
                                ->addTableTopButton(['type'=>'delete'])                         // 添加删除按钮
                                ->addTableRightButton(['type'=>'edit'])                         // 添加编辑按钮
                                ->addTableRightButton(['type'=>'forbid'])                       // 添加禁用/启用按钮
                                ->addTableRightButton(['type'=>'delete'])                       // 添加删除按钮
                                ->setTablePagination(['total'=>$total,'pageSize'=>$pageSize,'pageSizes'=>$pageSizes,'layout'=>'total, sizes, prev, pager, next, jumper'])//分页设置
                                ->setSearchTitle('请输入搜索内容')
                                ->setSearchSelect(['id'=>'ID','name'=>'用户名','email'=>'邮箱','mobile'=>'手机'])
                                ->setTitle('配置管理')
                                ->get();
        return response()->json($data, 200);
    }
}
