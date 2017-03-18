require('./bootstrap');
require('./cms/component');						//注册CMS组件

import store from './cms/store'                                //引入状态配置文件
import BuilderHtml from './components/builder/index.vue'      //引入页面内容构建器
import App from './components/app.vue'                            //主路由渲染页面
import IndexPage from './components/cms/index.vue'              //后台索引主页面
	const routes = [
        // { path: '/admin/login', name:mainData.config.loginRouterNmae, component: LoginPage },
        // { path: '/admin', name:'admin', component: IndexPage, children: adminChildren },
        { path: '/', name:'index', component: IndexPage },
    ]
    window.router = new VueRouter({
        mode: 'history',
        routes,                                                  // （缩写）相当于 routes: routes
    })
    new Vue({
        el: '#app',
        router,
        store,
        render: h => h(App)
    });                                                        //Vue程序启动