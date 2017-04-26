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
                <li v-if="menu.header" class="header">
                    {{ menu.title }}
                </li>
                <li v-else class="treeview">
                    <router-link :to="menu.path" active-class="active">
                        <i :class="menu.icon"></i><span>{{ menu.title }}</span>
                        <span v-if="menu.subMenus" class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </router-link>
                    <ul v-if="menu.subMenus" class="treeview-menu">
                        <li v-for="(subMenu, subKey, subIndex) in menu.subMenus">
                            <router-link :to="subMenu.path"><i :class="subMenu.icon"></i>{{ subMenu.title }}</router-link>
                        </li>
                    </ul>
                </li>
            </template>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
</template>
<script>
import { mapState } from 'vuex'
export default {
    created() {
        this.getMenus()
    },
    data() {
        return {
            menus :[],
        };
    },
    computed: {
        ...mapState({
            route: state => state.mainData.route,
            menu: state => state.mainData.menu,
        }),
    },
    methods:{
        // 获取子菜单
        subMenus(routeName){
            var subMenus = {};
            for (var key in this.menu) {
                if( this.menu[key].parent ==   routeName){
                    subMenus[key] = this.menu[key];
                }
            }
            return subMenus;
        },
        // 获取属性结构menus this.menus
        getMenus(){
            for (var key in this.menu) {
                let routeName = this.menu[key].name
                if (this.route[routeName]) {
                    this.menu[key].path =   this.route[routeName].path
                }
                if (this.isEmptyString(this.menu[key].icon)) {
                    this.menu[key].icon = 'fa fa-circle-o';
                }
                if (this.isEmptyString(this.menu[key].path)) {
                    this.menu[key].path = '';
                }
                if (this.isEmptyString(this.menu[key].parent)) {
                    if (!this.isEmptyObject(this.subMenus(routeName))) {
                        this.menu[key].subMenus = this.subMenus(routeName)
                    }
                    this.menus.push(this.menu[key])
                }
            }
        },
        isEmptyObject(value) {
            return Object.keys(value).length === 0;
        },
        isEmptyString(value){
            if (value === null || value === undefined || value === '') return true;
        }
    }
};
</script>
<style>
.router-link-active {
    color: #fff !important;
}
</style>
