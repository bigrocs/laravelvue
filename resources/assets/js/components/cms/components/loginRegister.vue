<template>
	<el-dialog title="登录注册" v-model="$store.state.loginRegisterDialogVisible" size="tiny">
	  <span>这是一段信息</span>
	  <span slot="footer" class="dialog-footer">
	    <el-button @click="handleLoginRegister">取 消</el-button>
	    <el-button type="primary" @click="handleLoginRegister">确 定</el-button>
	  </span>
	</el-dialog>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data() {
      	return {
      	};
    },
    methods: {
      	handleLoginRegister() {
      		  this.$store.dispatch('closeLoginRegisterDialogVisible') //关闭变登录注册组件
      	}
    }
}
</script>