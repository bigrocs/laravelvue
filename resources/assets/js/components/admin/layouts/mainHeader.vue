<template>
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>V</b>ue</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Laravel</b>Vue</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="javascript:void(0)"
            class="sidebar-toggle"
            data-toggle="offcanvas"
            role="button"
            @click="handleSiderbarToggle"
        >
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="http://cdn.bootcss.com/admin-lte/2.3.6/img/user2-160x160.jpg" class="user-image" alt="User Image">
                      <span class="hidden-xs">Alexander Pierce</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="http://cdn.bootcss.com/admin-lte/2.3.6/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                        <p>
                          Alexander Pierce - 后台管理员
                          <small>成员 注册时间 11月. 2012</small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-body">
                        <div class="row">
                          <div class="col-xs-4 text-center">
                            <a href="#">Followers</a>
                          </div>
                          <div class="col-xs-4 text-center">
                            <a href="#">Sales</a>
                          </div>
                          <div class="col-xs-4 text-center">
                            <a href="#">Friends</a>
                          </div>
                        </div>
                        <!-- /.row -->
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="#" class="btn btn-info btn-flat">用户中心</a>
                        </div>
                        <div class="pull-right">
                          <a href="#" class="btn btn-warning btn-flat" @click="handleSignOutSubmit">用户退出</a>
                        </div>
                      </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data(){
        return {

        }
    },
    computed: {
        ...mapState({
            login: state => state.mainData.apiUrl.login,
            logout: state => state.mainData.apiUrl.logout,
            loginRouterNmae: state => state.mainData.config.loginRouterNmae,
        }),
    },
    methods: {
        /**
         * [handleSignOutSubmit 用户退出]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-17T16:57:17+0800
         * @return   {[type]}                 [description]
         */
        handleSignOutSubmit(){
          this.$store.dispatch('getHttpNotify',{ url:this.logout })//退出
          setTimeout(() =>  {
              this.$router.push({name:this.loginRouterNmae})
          }, 3000);
        },
        /**
         * [handleSiderbarToggle 左侧导航切换]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-19T09:40:55+0800
         * @return   {[type]}                 [description]
         */
        handleSiderbarToggle(){
            document.body.classList.toggle('sidebar-collapse')
            // document.body.classList.toggle('sidebar-open')
        }
    }
}
</script>
