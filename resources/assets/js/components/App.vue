<template>
<div class="wrapper">
    <navbar></navbar>
    <sidebar></sidebar>
    <MainContent></MainContent>
</div>
</template>
<script>
import Navbar from './layouts/Navbar.vue'
import Sidebar from './layouts/Sidebar.vue'
import MainContent from './layouts/MainContent.vue'

export default {
    components: {
        Navbar,
        Sidebar,
        MainContent
    },
    replace: false
}
</script>
