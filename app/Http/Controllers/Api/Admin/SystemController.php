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
        $configPageSizes= Helpers::getPageSizes();
        foreach ($configPageSizes as &$pageSize) {
            $pageSize = $pageSize.' 条/页';
        }
        foreach ($adminConfigs as $adminConfig) {
            $adminConfig = $adminConfig;
            $adminConfig['label'] = $adminConfig['title'];
            $adminConfig['placeholder'] = $adminConfig['tip'];
            if ($adminConfig['type'] == 'textarea') {
                $adminConfig['rows'] = 5;
            }
            if ($adminConfig['type'] == 'picture') {
                $adminConfig['postUrl'] = '/api/admin/system/upload/image';
                $uploadData[] = Helpers::getUploadWhereFirst($adminConfig['value']);
                $adminConfig['fileList'] = $uploadData;
                $adminConfig['maxSize'] = 1048567;//上传文件限制
                $maxSizeLang['title'] = '图片大小超过限制';
                $maxSizeLang['message'] = '上传图片大小超过系统'.'1M'.'限制';
                $maxSizeLang['type'] = 'warning';
                $adminConfig['maxSizeLang'] = $maxSizeLang;
            }
            if ($adminConfig['name'] == 'ADMIN_PAGE_SIZE') {
                $adminConfig['options'] = $configPageSizes;//根据选择器分组
            }
        }
        $data = BuilderData::addFormData($adminConfigs)
                            ->addFormApiUrl('submit','/api/admin/system/system/update')              //添加Submit通信API
                            ->setTabs(Helpers::getTabsConfigGroupList())    //设置页面Tabs
                            ->setTitle('系统设置')
                            ->get();
        return response()->json($data, 200);
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
