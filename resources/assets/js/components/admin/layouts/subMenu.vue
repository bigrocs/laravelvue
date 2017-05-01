<template >
    <ul  class="treeview-menu">
        <li v-for="(menu, key, index) in subMenus">
            <router-link :to="menu.path"><i :class="menu.icon"></i>{{ menu.title }}
                <span v-if="menu.subMenus" class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </router-link>
            <sub-menu v-if="menu.subMenus" :subMenus="menu.subMenus"></sub-menu>
        </li>
    </ul> 
</template>
<script>
export default {
    beforeCreate: function () {
      this.$options.components.subMenu = require('./subMenu.vue')
    },
    props: {
        subMenus: {
            type: Object,
            default: ''
        },
    },
};
</script>
<style>
.router-link-active {
    color: #fff !important;
}
</style>
