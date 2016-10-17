<template>
<div class="wrapper">
    <navbar></navbar>
    <sidebar></sidebar>
</div>
</template>
<script>
import Navbar from './layouts/Navbar.vue'
import Sidebar from './layouts/Sidebar.vue'



export default {
    components: {
        Navbar,
        Sidebar
    },
    replace: false
}
</script>
