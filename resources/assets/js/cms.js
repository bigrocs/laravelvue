require('./bootstrap');

import store from './store'                                //引入状态配置文件
import BuilderHtml from './components/builder/index.vue'      //引入页面内容构建器
import App from './components/app.vue'                            //主路由渲染页面

    new Vue({
        el: '#app',
        // router,
        store,
        render: h => h(App)
    });                                                        //Vue程序启动