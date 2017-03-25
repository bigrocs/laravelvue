<template>
<div class="wrapper">
	<main-header></main-header>
	<!-- 弹窗类组件begin -->
	<login></login>
	<register></register>
	<!-- 弹窗类组件end -->
</div>
</template>
<script>
export default {
	created() {
		this.$store.dispatch('authCheck')//用户认证检查
    },
}
</script>