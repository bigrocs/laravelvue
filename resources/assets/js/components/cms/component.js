//页面组件
import mainHeader from './layouts/mainHeader.vue'
import mainContent from './layouts/mainContent.vue'
import mainFooter from './layouts/mainFooter.vue'
//登录注册组件
import loginRegister from './components/loginRegister.vue'

//组件注册
Vue.component('mainHeader', mainHeader);
Vue.component('mainContent', mainContent);
Vue.component('mainFooter', mainFooter);
Vue.component('loginRegister', loginRegister);