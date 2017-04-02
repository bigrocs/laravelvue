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

        $users->load('roles');//加载关联权限数据
        $users->load('userInfos');//加载关联头像数据
    
        $rolesConfig = ['type'=>'primary',    'keyNmae'=>'display_name'];   // rolesTags  tags显示配置      valueName显示数据对象名称 如果不填写默认显示整个对象
        $pictureConfig = ['keyNmae'=>'avatar', 'width'=>50, 'height'=>50, 'class'=>'img-responsive img-circle', 'alt'=>'用户头像'];
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
        foreach ($request->all() as $value) {
            $this->userModel->where('id', '=', $value['id'])->update(['status' => $value['status']]);
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
            $response = $this->userModel->find($value['id'])->forceDelete();
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
        $data = BuilderData::addFormApiUrl('submit','/api/admin/system/user/store')               //添加Submit通信API
                            ->addFormTitle('新增配置')                                           //添form表单页面标题
                            ->addFormItem(['name' => 'group',     'type' => 'select',   'label' => '配置分组',     'placeholder' => '配置所属的分组',                          'options'=>$configGroupList,    'value'=>0])
                            ->addFormItem(['name' => 'type',      'type' => 'select',   'label' => '配置类型',     'placeholder' => '配置类型的分组',                          'options'=>$formItemType,       'value'=>'text'])
                            ->addFormItem(['name' => 'name',      'type' => 'text',     'label' => '配置名称',     'placeholder' => '配置名称'])
                            ->addFormItem(['name' => 'title',     'type' => 'text',     'label' => '配置标题',     'placeholder' => '配置标题'])
                            ->addFormItem(['name' => 'value',     'type' => 'textarea', 'label' => '配置值',       'placeholder' => '配置值',                                   'rows'=>4])
                            ->addFormItem(['name' => 'options',   'type' => 'textarea', 'label' => '配置项',       'placeholder' => '如果是单选、多选、下拉等类型 需要配置该项',   'rows'=>4])
                            ->addFormItem(['name' => 'tip',       'type' => 'textarea', 'label' => '配置说明',     'placeholder' => '配置说明',                                  'rows'=>4])
                            ->addFormItem(['name' => 'sort',      'type' => 'number',   'label' => '排序',         'placeholder' => '用于显示的顺序'                             ,'value'=>0])
                            ->get();
        return response()->json($data, 200);
    }
}
