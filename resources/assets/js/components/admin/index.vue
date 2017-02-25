<template>
<div class="wrapper">
    <main-header></main-header>
    <main-sidebar></main-sidebar>
    <main-content></main-content>
    <main-footer></main-footer>
</div>
</template>
<script>
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
}
</script>
<style lang="less">
    // admin-lte皮肤
    @import "~admin-lte/build/less/skins/_all-skins.less";
</style>