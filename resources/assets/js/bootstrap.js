//全局组件定义
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');
window.axios = require('axios');                    //HTTP请求插件
window.VueRouter = require('vue-router');           //加载路由插件

//常用组件加载
require('bootstrap-less');                          //bootstrap JS编译
require('element-ui');                              //饿了么UI

//CSS样式加载
import 'bootstrap-less/bootstrap/bootstrap.less'    //bootstrap样式
import 'font-awesome/less/font-awesome.less'        //字体样式
import 'ionicons/dist/scss/ionicons.scss'           //字体样式
import 'element-ui/lib/theme-default/index.css'     //饿了吗框架样式

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
