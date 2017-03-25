<template>
<div class="wrapper">
    <main-header></main-header>
    <main-sidebar></main-sidebar>
    <main-content></main-content>
    <main-footer></main-footer>
</div>
</template>
<script>
import { mapState } from 'vuex'
import mainHeader from './layouts/mainHeader.vue'
import mainSidebar from './layouts/mainSidebar.vue'
import mainContent from './layouts/mainContent.vue'
import mainFooter from './layouts/mainFooter.vue'
export default {
    components: {
        mainHeader,
        mainSidebar,
        mainContent,
        mainFooter
    },
    created() {
        this.$store.dispatch('authCheck')//用户认证检查
        this.toLogin()
    },
    computed: {
        ...mapState({
            authStatus: state => state.authStatus,
            loginRouterNmae: state => state.mainData.config.loginRouterNmae,
        }),
    },
    methods:{
        /**
         * [toLogin 未登录成功跳转到登录页面]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-03-25T11:02:18+0800
         * @return   {[type]}                 [description]
         */
        toLogin(){
            if (!this.authStatus) {
                this.$router.push({name:this.loginRouterNmae})
            }
        },
    }
}
</script>
<style lang="less">
    // admin-lte
    @import "~admin-lte/build/less/core.less";
    @import "~admin-lte/build/less/variables.less";
    @import "~admin-lte/build/less/mixins.less";
    //COMPONENTS
    //-----------
    @import "~admin-lte/build/less/header.less";
    @import "~admin-lte/build/less/sidebar.less";
    @import "~admin-lte/build/less/sidebar-mini.less";
    @import "~admin-lte/build/less/control-sidebar.less";
    @import "~admin-lte/build/less/dropdown.less";
    @import "~admin-lte/build/less/forms.less";
    @import "~admin-lte/build/less/progress-bars.less";
    @import "~admin-lte/build/less/small-box.less";
    @import "~admin-lte/build/less/boxes.less";
    @import "~admin-lte/build/less/info-box.less";
    @import "~admin-lte/build/less/timeline.less";
    @import "~admin-lte/build/less/buttons.less";
    @import "~admin-lte/build/less/callout.less";
    @import "~admin-lte/build/less/alerts.less";
    @import "~admin-lte/build/less/navs.less";
    @import "~admin-lte/build/less/products.less";
    @import "~admin-lte/build/less/table.less";
    @import "~admin-lte/build/less/labels.less";
    @import "~admin-lte/build/less/direct-chat.less";
    @import "~admin-lte/build/less/users-list.less";
    @import "~admin-lte/build/less/carousel.less";
    @import "~admin-lte/build/less/modal.less";
    @import "~admin-lte/build/less/social-widgets.less";
    //PAGES
    //------
    @import "~admin-lte/build/less/mailbox.less";
    @import "~admin-lte/build/less/lockscreen.less";
    @import "~admin-lte/build/less/login_and_register.less";
    @import "~admin-lte/build/less/404_500_errors.less";
    @import "~admin-lte/build/less/invoice.less";
    @import "~admin-lte/build/less/profile";
    //Plugins
    //--------
    @import "~admin-lte/build/less/plugins.less";
    //Miscellaneous
    //-------------
    @import "~admin-lte/build/less/miscellaneous.less";
    @import "~admin-lte/build/less/print.less";
    // admin-lte皮肤
    @import "~admin-lte/build/less/skins/_all-skins";
    @boxed-layout-bg-image-path: "~admin-lte/dist/img/boxed-bg.jpg";
    @body-bg: #ecf0f5;
</style>