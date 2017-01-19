<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminConfig;
use BuilderData;

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
        $group = $request->get('tabsId');
        $group = empty($group) ? 0 : $group;
        $adminConfigs = $this->adminConfigModel
                            ->where('group', '=', $group)
                            ->orderBy('sort', 'ASC')
                            ->where('status', '=', 1)
                            ->get();
        foreach ($adminConfigs as $key => $adminConfig) {
            $adminConfig = $adminConfig;
            $adminConfig['label'] = $adminConfig['title'];
            $adminConfig['placeholder'] = $adminConfig['tip'];
            if ($adminConfig['type'] == 'textarea') {
                $adminConfig['rows'] = 5;
            }
            if ($adminConfig['type'] == 'picture') {
                $adminConfig['postUrl'] = 'api/admin/upload/image';
                $uploadData[] = getUploadWhereOne($adminConfig['value']);
                $adminConfig['fileList'] = $uploadData;
                $adminConfig['maxSize'] = 1048567;//上传文件限制
                $maxSizeLang['title'] = '图片大小超过限制';
                $maxSizeLang['message'] = '上传图片大小超过系统'.'1M'.'限制';
                $maxSizeLang['type'] = 'warning';
                $adminConfig['maxSizeLang'] = $maxSizeLang;
            }
        }
        $tabs = explode(',', getAdminConfig('CONFIG_GROUP_LIST'));
        $data = BuilderData::addFormData($adminConfigs)
                            ->addFormApiUrl('urlSubmit','api/admin/system/update')              //添加Submit通信API
                            ->addTabs($tabs)    //设置页面Tabs
                            ->setTitle('系统设置')
                            ->get();
        return response()->json($data, 200);
    }
    public function update(Request $request){
        foreach ($request->all() as $value) {
            $adminConfig = $this->adminConfigModel->where('id', '=', $value['id'])->update(['value' => $value['value']]);
        }
        $data = [
                    'title'     => '保存成功',
                    'message'   => '系统设置保存成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
}
