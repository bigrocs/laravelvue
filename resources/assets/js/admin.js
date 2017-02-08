/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//后台JS插件
require('admin-lte');                               //AdminLTE JS编译
require('jquery-slimscroll');                       //页面滚动插件 SlimScroll
require('fastclick');                               //快速点击插件 fastClick
//后台样式引入
// import '../less/AdminLTE.less'         //AdminLTE样式
import 'admin-lte/build/less/skins/_all-skins.less' //AdminLTE皮肤样式

import BuilderHtml from './components/builder/index.vue'      //引入页面内容构建器
import store from './store.js'                                //引入状态配置文件

import App from './components/admin/app.vue'                  //引入页面主程序
import Login from './components/admin/login.vue'                  //引入页面主程序


let apiUrl = $('#app').attr('apiUrl');                    //获取主API网址

axios.post(apiUrl).then((Response) => {
    store.state.data = Response.data                          //初始化全局变量(服务端API数据)

    const routes=[]                                           //begin解析路由JSON
    for(var key in Response.data.routes){
        if(Response.data.routes[key].path!=null){
            routes[key] = {
                path: Response.data.routes[key].path,
                name: Response.data.routes[key].name,
                component: BuilderHtml
            }
        }
    }
    routes.push({path:'/login',name:'login',component:Login})
    console.log(routes);
    const router = new VueRouter({
        routes,                                                  // （缩写）相当于 routes: routes
    })
    new Vue({
        el: '#app',
        router,
        store,
        render: h => h(App)
    });                                                        //Vue程序启动
},(response) => {
    console.log('获取主配置信息失败!');
    console.log('请检查store.js文件Config.Api.mainUrl配置参数是否正确,或者服务端是否通信正常。');
    console.log('服务端返回状态如下：');
    console.log(response);
});
