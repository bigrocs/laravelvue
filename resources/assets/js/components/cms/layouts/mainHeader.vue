<template>
<header class="main-header">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">LaravelVue</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#">首页 <span class="sr-only">(current)</span></a></li>
	        <li><a href="#">文档</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">产品 <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">产品1</a></li>
	            <li><a href="#">产品2</a></li>
	            <li><a href="#">产品3</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">产品4</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">产品5</a></li>
	          </ul>
	        </li>
	      </ul>
	      <form class="navbar-form navbar-left">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="请输入搜索关键词">
	        </div>
	        <button type="submit" class="btn btn-default">搜索</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="javascript:void(0)" @click="handleLoginRegister">登录/注册</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员中心 <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">会员中心</a></li>
	            <li><a href="#">会员中心</a></li>
	            <li><a href="#">会员中心</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">会员中心</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<login-register></login-register>
</header>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data() {
      	return {
      	};
    },
    computed: {
        ...mapState({
            loginRegisterDialogVisible: 'loginRegisterDialogVisible',
        }),
    },
    methods: {
      	handleLoginRegister() {
      		this.$store.dispatch('openLoginRegisterDialogVisible') //关闭
      		console.log(this.loginRegisterDialogVisible);
      	}
    }
}
</script>