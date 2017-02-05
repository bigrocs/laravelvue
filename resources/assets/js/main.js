/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import BuilderHtml from './components/builder/index.vue'      //引入页面内容构建器
import App from './components/app.vue'                        //引入页面主程序
import store from './store.js'                                //引入状态配置文件

axios.post(store.state.Config.Api.mainUrl).then((Response) => {
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
