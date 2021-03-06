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

import store from './store'                                 //引入状态配置文件
import BuilderHtml from './components/builder/index.vue'          //引入页面内容构建器
import App from './components/app.vue'                            //主路由渲染页面
import IndexPage from './components/admin/index.vue'              //后台索引主页面
import LoginPage from './components/admin/login.vue'              //后台登录页面
import notFound from './components/admin/notFound.vue'            //后台404页面


axios.post(window.Laravel.apiUrl).then((Response) => {
    let mainData = store.state.mainData = Response.data                 //初始化全局变量(服务端API数据)
    let adminChildren = []                                            //begin解析路由JSON
    for (var key in mainData.routes) {
        adminChildren.push({
            name: mainData.routes[key].name,
            path: mainData.routes[key].path,
            component: BuilderHtml,
            meta: { apiUrl: mainData.routes[key].apiUrl }
        })
    }
    adminChildren.push({ path: '*', name:'notFound', component: notFound }) //404页面
    let routes = [
        { path: mainData.config.loginUrl, name:mainData.config.loginRouterNmae, component: LoginPage },
        { path: '/admin', component: IndexPage, children: adminChildren },
    ]

    startVue(routes,store) //启动VUE

},(response) => {
    console.log('获取主配置信息失败!');
    console.log('请检查store.js文件Config.Api.mainUrl配置参数是否正确,或者服务端是否通信正常。');
    console.log('服务端返回状态如下：');
    console.log(response);
});


const startVue = function(routes,store){
    window.router = new VueRouter({
        mode: 'history',
        routes,                                                  // （缩写）相当于 routes: routes
    })
    new Vue({
        el: '#app',
        router,
        store,
        render: h => h(App)
    });
}
