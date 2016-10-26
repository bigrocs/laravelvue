import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './components/App.vue'

import Element from 'element-ui'
import 'element-ui/lib/theme-default/index.css'

Vue.use(VueRouter)
Vue.use(Element)

import routes from './router.js'//引入路由器配置文件

const router = new VueRouter({
  routes // （缩写）相当于 routes: routes
})

new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
