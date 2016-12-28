<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminConfig;

class SystemController extends Controller
{
    /** @var AdminConfigRepository */
    private $adminConfigModel;

    public function __construct(AdminConfig $adminConfigRepo)
    {
        $this->adminConfigModel = $adminConfigRepo;
    }
    public function index($group = 0)
    {
        $data = [
            'form' => [
                'type'    => 'form',
                'url'     => 'api/admin/system',
                'method'  => 'post',
                'datas'   => [
                ]
            ]
        ];
        $adminConfigs = $this->adminConfigModel
                            // ->where('group', '=', $group)
                            ->orderBy('sort', 'ASC')
                            ->where('status', '=', 1)
                            ->get();
        foreach ($adminConfigs as $key => $adminConfig) {
            $data['form']['datas'][$key] = $adminConfig;
            $data['form']['datas'][$key]['label'] = $adminConfig['title'];
            $data['form']['datas'][$key]['placeholder'] = $adminConfig['tip'];
            if ($adminConfig['type'] == 'textarea') {
                $data['form']['datas'][$key]['rows'] = 5;
            }

        }
        return response()->json($data, 200);
    }
    public function update(Request $request){
        foreach ($request->all() as $value) {
            $adminConfig = $this->adminConfigModel->where('name', '=', $value['name'])->update(['value' => $value['value']]);
        }
        $data = [
                    'title'     => '保存成功',
                    'message'   => '系统设置保存成功!',
                    'type'      => 'success',
                ];
        return response()->json($data, 200);
    }
}
