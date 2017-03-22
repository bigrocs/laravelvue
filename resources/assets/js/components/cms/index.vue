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
import { mapState } from 'vuex'
export default {
	created() {
        this.authCheck();//用户认证检查
    },
    computed: {
        ...mapState({
            authCheckUrl: state => state.mainData.apiUrl.authCheck,
        }),
    },
	methods: {
		/**
		 * [authCheck 检查登录状态]
		 * @author BigRocs
		 * @email    bigrocs@qq.com
		 * @DateTime 2017-03-22T11:20:26+0800
		 * @return   {[type]}                 [description]
		 */
		authCheck(){
			let thenFunction = (Response) => {
	            if (Response.data.state) {
	                this.$store.dispatch('authCheckTrue')
	            }else{
	            	this.$store.dispatch('authCheckFalse')
	            }
	        }
			this.$store.dispatch('getHttpNotify',{ url:this.authCheckUrl, thenFunction, notification:false})//登录
		}
	}
}
</script>