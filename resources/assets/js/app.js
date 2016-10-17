
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueRouter from 'vue-router'
import App from './components/App.vue'

Vue.use(VueRouter)


const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
const routes = [
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar }
]
const router = new VueRouter({
  routes // （缩写）相当于 routes: routes
})
const app = new Vue({
    render: function (createElement) {
      return createElement(App);
    },
    router
}).$mount('#body')




// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#body'
// });
