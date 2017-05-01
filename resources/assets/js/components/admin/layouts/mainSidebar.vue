<template>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/assets/apps/img/avatar.jpeg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>laravelVue Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> -->
        <ul class="sidebar-menu">
            <template v-for="(menu, key, index) in menus">
                <li v-if="menu.type == 'header'" class="header">
                    {{ menu.title }}
                </li>
                <li v-else-if="menu.pid == 0" class="treeview">
                    <router-link :to="menu.path" active-class="active">
                        <i :class="menu.icon"></i><span>{{ menu.title }}</span>
                        <span v-if="menu.subMenus" class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </router-link>
                    <sub-menu v-if="menu.subMenus" :subMenus="menu.subMenus"></sub-menu>
                </li>
            </template>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
</template>
<script>
import subMenu from './subMenu.vue'
import { mapState } from 'vuex'
export default {
    components: {
        subMenu
    },
    computed: {
        ...mapState({
            menus: state => state.mainData.menus,
        }),
    },
};
</script>
<style>
.router-link-active {
    color: #fff !important;
}
</style>
