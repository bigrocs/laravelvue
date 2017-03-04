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
     * [setRoute 设置路由线路]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-04T11:57:17+0800
     * @param    [type]                   $name   [路由名称]
     * @param    [type]                   $path   [路由路径]
     * @param    [type]                   $apiUrl [当前路由的API通信地址]
     */
    public function setRoute($name,$path,$apiUrl=null){
        // $this->data['route'][$name] = $path;
        $this->data['route'][] = ['name'=>$name, 'path'=>$path, 'apiUrl'=>$apiUrl];
        return $this;
    }
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
    public function setApiUrl($key,$value){
        $this->data['apiUrl'][$key] = $value;
        return $this;
    }
    public function get(){
        return $this->data;
    }
}
