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
    public function setRoute($name,$path,$apiUrl=''){
        $this->data['routes'][$name] = ['name'=>$name, 'path'=>$path, 'apiUrl'=>$apiUrl];
        return $this;
    }
    /**
     * [setRoute 批量设置路由线路]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-04T11:57:17+0800
     * @param    [type]                   $menus   [菜单数据信息]
     */
    public function setRoutes($menus){
        foreach ($menus as $menu) {
            if ($menu->api_route) {
                 $this->data['routes'][$menu->id] = ['name'=>$menu->api_route, 'path'=>$menu->value, 'apiUrl'=> route($menu->api_route)];
            }
        }
        return $this;
    }
    /**
     * [setMenus 批量设置导航菜单]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-05-01T08:48:13+0800
     * @param    [type]                   $menus [description]
     */
    public function setMenus($menus){
        $menus = $menus->map(function ($menu) {
            $menu->path = $menu->value;
            $menu->apiUrl = $menu->api_url;
            return $menu;
        })->filter(function ($menu, $key) use($menus) {
            if ($menu->pid == 0) {
                $menu = $this->getSubMenus($menu,$menus);
            }
            return $menu->pid == 0;
        });
        $this->data['menus'] = $menus;
        return $this;
    }
    /**
     * [getSubMenus 设置子导航(可无限级设置)]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-05-01T10:34:33+0800
     * @param    [type]                   $menu  [description]
     * @param    [type]                   $menus [description]
     * @return   [type]                          [description]
     */
    public function getSubMenus($menu,$menus){
        $id = $menu->id;
        $subMenus = $menus->filter(function ($menu, $key) use($id,$menus) {
            if ($menu->pid == $id) {
                $menu = $this->getSubMenus($menu,$menus);
            }
            return $menu->pid == $id;
        });
        if (!$subMenus->isEmpty()) {
            $menu->subMenus = $subMenus;
        }
        return $menu;
    }
    /**
     * [setMenu 设置导航菜单]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-04T14:07:22+0800
     * @param    [type]                   $name   [对应路由名称]
     * @param    [type]                   $title  [菜单标题]
     * @param    string                   $icon   [图标]
     * @param    string                   $parent [父菜单name]
     * @param    boolean                  $header [是否是header菜单]
     */
    public function setMenu($name,$title,$icon='',$parent='',$header=''){
        $this->data['menus'][] = ['name'=>$name, 'title'=>$title, 'icon'=>$icon, 'parent'=>$parent, 'header'=>$header];
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
        return response()->json($this->data);
    }
}
