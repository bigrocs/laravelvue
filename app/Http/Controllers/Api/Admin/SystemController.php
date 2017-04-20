<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminConfig;

use Facades\ {
    App\Facades\BuilderData,
    App\Facades\Helpers
};
class SystemController extends Controller
{
    /** @var AdminConfigRepository */
    private $adminConfigModel;

    public function __construct(AdminConfig $adminConfigRepo)
    {
        $this->adminConfigModel = $adminConfigRepo;
    }
    public function index(Request $request)
    {
        $group = $request->tabIndex;
        $group = empty($group) ? 0 : $group;
        $adminConfigs = $this->adminConfigModel
                            ->where('group', '=', $group)
                            ->orderBy('sort', 'ASC')
                            ->where('status', '=', 1)
                            ->get();
        return $data = BuilderData::addFormData($adminConfigs)
                            ->addFormApiUrl('submit','/api/admin/system/system/update')              //添加Submit通信API
                            ->setTabs(Helpers::getTabsConfigGroupList())    //设置页面Tabs
                            ->setTitle('系统设置')
                            ->setFormConfig(['width'=>'100px'])
                            ->get();
    }
    public function update(Request $request){
        $input = $request->all();
        foreach ($input as $name => $value) {
            $adminConfig = $this->adminConfigModel->where('name', '=', $name)->update(['value' => $value]);
        }
        $data = [
                    'title'     => '保存成功',
                    'message'   => '系统设置保存成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
}
