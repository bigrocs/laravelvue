
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
window.axios = require('axios');

window.VueRouter = require('vue-router');   //加载路由插件

require('element-ui');                      //饿了么UI
// import 'element-ui/lib/theme-default/index.css' //已在less引入外币CSS不在重复

require('admin-lte/dist/js/app.js')// //AdminLTE JS编译
require('jquery-slimscroll/jquery.slimscroll.js')//页面滚动插件 SlimScroll
require('fastclick/lib/fastclick.js')//快速点击插件 fastClick


/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

 window.axios.defaults.headers.common = {
     // 'X-CSRF-TOKEN': window.Laravel.csrfToken,
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
