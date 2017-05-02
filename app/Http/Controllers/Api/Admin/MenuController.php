<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Menu;
use Facades\ {
    App\Facades\BuilderData,
    App\Facades\Helpers
};
class MenuController extends Controller
{
    /** @var MenuRepository */
    private $menuModel;

    public function __construct(Menu $menuRepo)
    {
        $this->menuModel = $menuRepo;
    }
    /**
     * [index 表格列表显示]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-05-01T14:45:36+0800
     * @param    Request                  $request [description]
     * @return   [type]                            [description]
     */
    public function index(Request $request)
    {
        //处理下请求数据
        list($group,$pageSizes,$pageSize,$page,$selectSearch,$inputSearch) = Helpers::compileTableRequest($request);
        // [$total 获取数据总数]
        $total = $this->menuModel
                            ->where('group', '=', $group)
                            ->where('status', '>=', 0)
                            ->where($selectSearch, 'like', $inputSearch)
                            ->count();

        // [$menus 获取数据对象]
        $menus = $this->menuModel
                            ->page($page, $pageSize)
                            ->orderBy('sort', 'ASC')
                            ->where('group', '=', $group)
                            ->where('status', '>=', 0)
                            ->where($selectSearch, 'like', $inputSearch)
                            ->get();
        return $data = BuilderData::addTableData($menus)
                                ->addTableColumn(['prop' => 'id',         'label'=> 'ID',     'width'=> '55'])
                                ->addTableColumn(['prop' => 'icon',       'label'=> '图标',	  'width'=> '65',		'type' => 'icon'])
                                ->addTableColumn(['prop' => 'title',      'label'=> '标题',   'minWidth'=> '160'])
                                ->addTableColumn(['prop' => 'type',       'label'=> '类型',   'minWidth'=> '100'])
                                ->addTableColumn(['prop' => 'value',      'label'=> '菜单值', 'minWidth'=> '180'])
                                ->addTableColumn(['prop' => 'api_route',    'label'=> 'API路由名','minWidth'=> '270'])
                                ->addTableColumn(['prop' => 'sort',       'label'=> '排序',   'width'=> '70'])
                                ->addTableColumn(['prop' => 'status',     'label'=> '状态',   'minWidth'=> '90',	'type' => 'status'])
                                ->addTableColumn(['prop' => 'rightButton','label'=> '操作',   'minWidth'=> '220',	'type' => 'btn'])
                                ->addTableTopButton(['buttonType'=>'add',       'apiUrl'=> route('api.admin.system.menu.add'),'title'=>'添加配置'])                         // 添加新增按钮
                                ->addTableTopButton(['buttonType'=>'resume',    'apiUrl'=> route('api.admin.system.menu.status')])                         // 添加启用按钮
                                ->addTableTopButton(['buttonType'=>'forbid',    'apiUrl'=> route('api.admin.system.menu.status')])                         // 添加禁用按钮
                                ->addTableTopButton(['buttonType'=>'delete',    'apiUrl'=> route('api.admin.system.menu.delete')])                         // 添加删除按钮
                                ->addTableRightButton(['buttonType'=>'edit',    'apiUrl'=> route('api.admin.system.menu.edit')])                         // 添加编辑按钮
                                ->addTableRightButton(['buttonType'=>'forbid',  'apiUrl'=> route('api.admin.system.menu.status')])                       // 添加禁用/启用按钮
                                ->addTableRightButton(['buttonType'=>'delete',  'apiUrl'=> route('api.admin.system.menu.delete')])                       // 添加删除按钮
                                ->setTabs(Helpers::getTabsMenuGroupList())                                                //设置页面Tabs
                                ->setTablePagination(['total'=>$total,'pageSize'=>$pageSize,'pageSizes'=>$pageSizes,'layout'=>'total, sizes, prev, pager, next, jumper'])//分页设置
                                ->setSearchTitle('请输入搜索内容')
                                ->setSearchSelect(['id'=>'ID','name'=>'名称','title'=>'标题'])
                                ->setTitle('配置管理')
                                ->get();
    }
}
