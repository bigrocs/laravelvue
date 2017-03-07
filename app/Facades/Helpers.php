<?php
namespace App\Facades;

use App\Models\Upload;
use App\Models\AdminConfig;

/**
 * laravelVue Helpers助手门面方法
 * @author BigRocs <bigrocs@qq.com>
 * @date   2016-05-08T13:51:33+0800
 */
class Helpers
{
    private $adminConfigModel;
    private $uploadModel;

    public function __construct(
        AdminConfig $adminConfigRepo,
        Upload $uploadRepo
    ){
        $this->adminConfigModel = $adminConfigRepo;
        $this->uploadModel = $uploadRepo;
    }
    /**
     * [getUploadWhereFirst 根据ID获取上传文件对象单条URL信息]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-07T13:39:38+0800
     * @param    [type]                   $id [文件ID]
     * @return   [type]                       [description]
     */
    public function getUploadWhereFirst($id){
        return $this->uploadModel->getUploadWhereFirst($id);
    }
    /**
     * [getAdminConfig 获取后台配置数据]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-07T13:53:18+0800
     * @param    [type]                   $name [配置常量名]
     * @return   [type]                         [description]
     */
    public function getAdminConfig($name){
        $AdminConfigData = $this->adminConfigModel->where('status', '=', 1)->where('name','=', $name)->first();
        return $AdminConfigData->value;
    }
    public function getPageSize(){
        $pageSizes = explode(',', $this->getAdminConfig('ADMIN_PAGE_SIZES'));
        return $pageSizes[intval($this->getAdminConfig('ADMIN_PAGE_SIZE'))];
    }
}
