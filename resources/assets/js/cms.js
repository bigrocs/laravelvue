require('./bootstrap');
require('./cms/component');						//注册CMS组件

import store from './store'                                //引入状态配置文件
import BuilderHtml from './components/builder/index.vue'      //引入页面内容构建器
import App from './components/app.vue'                            //主路由渲染页面
import IndexPage from './components/cms/index.vue'              //后台索引主页面


axios.post(window.Laravel.apiUrl).then((Response) => {
    let mainData = store.state.mainData = Response.data                 //初始化全局变量(服务端API数据)

    let adminChildren = []                                            //begin解析路由JSON
    for (var key in mainData.route) {
        adminChildren.push({
            name: mainData.route[key].name,
            path: mainData.route[key].path,
            component: BuilderHtml, 
            meta: { apiUrl: mainData.route[key].apiUrl }
        })
    }
    let routes = [
        // { path: '/admin/login', name:mainData.config.loginRouterNmae, component: LoginPage },
        { path: '/', name:'index', component: IndexPage, children: adminChildren },
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