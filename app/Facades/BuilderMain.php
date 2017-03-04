<?php
namespace App\Facades;
/**
 * laravelVue Main数据构造器
 * @author BigRocs <bigrocs@qq.com>
 * @date   2016-05-08T13:51:33+0800
 */
class BuilderMain
{
    private $data;                                      // 数据
    /**
     * [setConfig 设置配置数据]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-04T09:58:45+0800
     * @param    [type]                   $key   [description]
     * @param    [type]                   $value [description]
     */
    public function setConfig($key,$value){
        $this->data['config'][$key] = $value;
        return $this;
    }
    /**
     * [getApiUrl 设置API通信网址]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-04T10:00:46+0800
     * @param    [type]                   $key   [description]
     * @param    [type]                   $value [description]
     * @return   [type]                          [description]
     */
    public function getApiUrl($key,$value){
        $this->data['apiUrl'][$key] = $value;
        return $this;
    }
    public function get(){
        return $this->data;
    }
}
