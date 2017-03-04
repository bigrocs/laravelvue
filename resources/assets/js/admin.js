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

import store from './store'                                //引入状态配置文件
import BuilderHtml from './components/builder/index.vue'      //引入页面内容构建器
import App from './components/admin/app.vue'                  //主渲染页面
import IndexPage from './components/admin/index.vue'              //后台索引主页面
import LoginPage from './components/admin/login.vue'              //后台索引主页面

axios.post(window.Laravel.apiUrl).then((Response) => {
    store.state.mainData = Response.data                          //初始化全局变量(服务端API数据)

    const adminChildren=[]                                           //begin解析路由JSON
    for(var key in Response.data.routes){
        if(Response.data.routes[key].path!=null){
            adminChildren[key] = {
                path: Response.data.routes[key].path,
                name: Response.data.routes[key].name,
                component: BuilderHtml, 
                meta: { requiresAuth: true }
            }
        }
    }
    const routes = [
        { path: '/admin/login', name:store.state.mainData.config.loginRouterNmae, component: LoginPage },
        { path: '/admin', name:'admin', component: IndexPage, children: adminChildren, meta: { requiresAuth: true }},
    ]
    window.router = new VueRouter({
        mode: 'history',
        routes,                                                  // （缩写）相当于 routes: routes
    })
    /**
     * [登录判断]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-02-17T14:47:27+0800
     * @param    {[type]}                 (to, from,         next [description]
     * @return   {[type]}                      [description]
     */
    // router.beforeEach((to, from, next) => {
    //     if (to.meta.requiresAuth) {
    //         const authUser = JSON.parse(window.localStorage.getItem('authUser'))
    //         if (authUser && authUser.accessToken) {
    //             next()
    //         }else{
    //             next({name:'login'})
    //         }
    //     }
    //     next()
    // })
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
