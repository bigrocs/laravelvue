<template>
	<el-dialog title="提示" v-model="LoginRegisterDialogVisible" size="tiny">
	  <span>这是一段信息</span>
	  <span slot="footer" class="dialog-footer">
	    <el-button @click="LoginRegisterDialogVisible = false">取 消</el-button>
	    <el-button type="primary" @click="LoginRegisterDialogVisible = false">确 定</el-button>
	  </span>
	</el-dialog>
</template>
<script>
  export default {
    data() {
      	return {
      		LoginRegisterDialogVisible : true,
      	};
    },
    methods: {
      	handleLoginRegister() {
      		this.LoginRegisterDialogVisible = true;
      		console.log(this.LoginRegisterDialogVisible);
      	}
    }
  }
</script>