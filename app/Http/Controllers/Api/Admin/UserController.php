<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Facades\ {
    App\Facades\BuilderData,
    App\Facades\Helpers
};

class UserController extends Controller
{
	/** @var userRepo */
    private $userModel;
    private $roleModel;

    public function __construct(User $userRepo,Role $rolePepo)
    {
        $this->userModel = $userRepo;
        $this->roleModel = $rolePepo;
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

        $users->load('roles');//加载关联权限数据
        $users->load('userInfos');//加载关联头像数据
    
        $rolesConfig = ['type'=>'primary',    'keyNmae'=>'display_name'];   // rolesTags  tags显示配置      valueName显示数据对象名称 如果不填写默认显示整个对象
        $pictureConfig = ['keyNmae'=>'avatarUrl', 'width'=>50, 'height'=>50, 'class'=>'img-responsive img-circle', 'alt'=>'用户头像'];
        $data = BuilderData::addTableData($users)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> '55'])
                                ->addTableColumn(['prop' => 'user_infos', 'label'=> '头像',   'width'=> '90',    'type' => 'picture',    'config'=>$pictureConfig])
                                ->addTableColumn(['prop' => 'roles',      'label'=> '角色',   'minWidth'=> '120',    'type' => 'tags',       'config'=>$rolesConfig])
                                ->addTableColumn(['prop' => 'name',       'label'=> '用户名', 'minWidth'=> '120'])
                                ->addTableColumn(['prop' => 'email',      'label'=> '邮箱',   'minWidth'=> '180'])
                                ->addTableColumn(['prop' => 'mobile',     'label'=> '手机',   'minWidth'=> '180'])
                                ->addTableColumn(['prop' => 'status',     'label'=> '状态',   'width'=> '90',      'type' => 'status'])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'minWidth'=> '220',  'type' => 'btn'])
                                ->addTableApiUrl('status','/api/admin/system/user/status')         //添加状态通信API
                                ->addTableApiUrl('delete','/api/admin/system/user/delete')         //添加删除通信API
                                ->addTableApiUrl('add','/api/admin/system/user/add')               //添加数据接口
                                ->addTableApiUrl('edit','/api/admin/system/user/edit')             //添加数据接口
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
    public function status(Request $request){
        $input = $request->all();
        foreach ($input as $id => $value) {
            $this->userModel->where('id', '=', $id)->update(['status' => $value]);
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
            $response = $this->userModel->find($id)->forceDelete();
        }
        $data = [
                    'title'     => '删除成功',
                    'message'   => '后台配置数据删除成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
    public function add(){
        $roles = $this->roleModel->all();
        $roles->transform(function ($item, $key) {
            $item['name'] = $item['display_name'];
            return $item;
        });
        $data = BuilderData::addFormApiUrl('submit','/api/admin/system/user/store')               //添加Submit通信API
                            ->setFormTitle('新增用户')                                           //添form表单页面标题
                            ->setFormConfig(['width'=>'90px'])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '用户名'     ])
                            ->addFormItem(['name' => 'email',     'type' => 'text',     'label' => '用户邮箱'   ])
                            ->addFormItem(['name' => 'mobile',    'type' => 'text',     'label' => '用户手机'   ])
                            ->addFormItem(['name' => 'password',  'type' => 'password', 'label' => '用户密码'   ])
                            ->addFormItem(['name' => 'checkPassword','type' => 'password','label' => '密码验证'])
                            ->addFormItem(['name' => 'roles',     'type' => 'checkbox', 'label' => '用户角色',  'value'=>[2], 'options'=>$roles])
                            ->addFormItem(['name' => 'avatar',    'type' => 'picture',  'label' => '用户头像',  'uploadUrl'=>'/api/admin/system/upload/image', 'width'=>'250px', 'height'=>'250px'])
                            ->addFormItem(['name' => 'integral',  'type' => 'number',   'label' => '用户积分'   ])
                            ->addFormItem(['name' => 'money',     'type' => 'number',   'label' => '用户余额'  ])
                            ->setFormRules($this->userModel->getRules())
                            ->get();
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $user = $this->userModel->create($input);
        $user->roles()->attach($request->roles);//增加用户角色
        $response = $user->userInfos()->create($input);//插入关联数据库userInfos
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
        $users = $this->userModel->find($request->id);
        $users->load('roles');//加载关联权限数据
        $users->load('userInfos');//加载关联头像数据
        $users->roles->transform(function ($item, $key) {
            return $item['id'];
        });//处理集合只留id
        $roles = $this->roleModel->all();
        $roles->transform(function ($item, $key) {
            $item['name'] = $item['display_name'];
            return $item;
        });
        $data = BuilderData::addFormApiUrl('submit','/api/admin/system/user/update')               //添加Submit通信API
                            ->setFormTitle('编辑用户')                                           //添form表单页面标题
                            ->setFormConfig(['width'=>'90px'])
                            ->addFormItem(['name' => 'id',        'type' => 'hidden',   'label' => 'ID'     ])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '用户名'     ])
                            ->addFormItem(['name' => 'email',     'type' => 'text',     'label' => '用户邮箱'   ])
                            ->addFormItem(['name' => 'mobile',    'type' => 'text',     'label' => '用户手机'   ])
                            ->addFormItem(['name' => 'password',  'type' => 'password',  'label' => '用户密码' ])
                            ->addFormItem(['name' => 'checkPassword','type' => 'password','label' => '密码验证'])
                            ->addFormItem(['name' => 'roles',     'type' => 'checkbox', 'label' => '用户角色', 'options'=>$roles])
                            ->addFormItem(['name' => 'avatar',    'type' => 'picture',  'label' => '用户头像', 'loadAttribute'=>['user_infos.avatar','imageUrl'=>'user_infos.avatarUrl'], 'uploadUrl'=>'/api/admin/system/upload/image', 'width'=>'250px', 'height'=>'250px'])
                            ->addFormItem(['name' => 'integral',  'type' => 'number',   'label' => '用户积分', 'loadAttribute'=>['user_infos.integral']])
                            ->addFormItem(['name' => 'money',     'type' => 'number',   'label' => '用户余额', 'loadAttribute'=>['user_infos.money']])
                            ->setFormObject($users)
                            ->setFormRules($this->userModel->getRules())
                            ->get();
        return response()->json($data, 200);
    }
    public function update(Request $request)
    {
        $input = $request->all();
        if(!$input['password']){
            unset($input['password']);
        }
        $user = $this->userModel->find($input['id']);
        $user->fill($input)->save();
        $user->roles()->sync($request->roles);//更新用户角色
        $user->userInfos()->update(['avatar'=>$request->avatar, 'integral'=>$request->integral, 'money'=>$request->money]);
        $data = [
                        'title'     => '用户编辑成功！',
                        'message'   => '编辑用户数据成功！!',
                        'type'      => 'success',
                    ];
        return response()->json($data, 200);
    }
}
