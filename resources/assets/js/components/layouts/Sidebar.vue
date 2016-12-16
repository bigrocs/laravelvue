<template>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://cdn.bootcss.com/admin-lte/2.3.6/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>laravelCmf Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <template v-for="(menu, key, index) in menus">
                <li v-if="menu.header" class="header">
                    {{ menu.title }}
                </li>
                <li v-else>
                    <router-link :to="menu.path" active-class="a">
                        <i :class="menu.icon"></i>{{ menu.title }}
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </router-link>
                    <ul v-if="menu.subRoutes" class="treeview-menu">
                        <li v-for="(subMenu, subKey, subIndex) in menu.subRoutes">
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
export default {
    created() {
        this.getMenus()
    },
    data() {
        return {
            routes : this.$store.state.data.routes,
            menus :[],
        };
    },
    methods:{
        // 获取子菜单
        subRoutes(routeName){
            var subRoutes = {};
            for (var key in this.routes) {
                if( this.routes[key].parent ==   routeName){
                    subRoutes[key] = this.routes[key];
                }
            }
            return subRoutes;
        },
        // 获取属性结构menus this.menus
        getMenus(){
            for (var key in this.routes) {
                if (this.isEmptyString(this.routes[key].path)) {
                    this.routes[key].path = '';
                }
                if (this.isEmptyString(this.routes[key].parent)) {
                    this.routes[key].subRoutes = this.subRoutes(this.routes[key].name)
                    this.menus[this.menus.length] = this.routes[key]
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
