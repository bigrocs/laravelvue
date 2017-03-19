//页面组件
import mainHeader from './../components/cms/layouts/mainHeader.vue'
import mainContent from './../components/cms/layouts/mainContent.vue'
import mainFooter from './../components/cms/layouts/mainFooter.vue'
//登录注册组件
import login from './../components/cms/components/login.vue'
import register from './../components/cms/components/register.vue'

//组件注册
Vue.component('mainHeader', mainHeader);
Vue.component('mainContent', mainContent);
Vue.component('mainFooter', mainFooter);
Vue.component('login', login);
Vue.component('register', register);