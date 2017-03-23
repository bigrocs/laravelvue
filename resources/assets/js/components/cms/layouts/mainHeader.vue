<template>
<header class="main-header navbar-div">
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
	      	<template v-if="$store.state.authStatus">        
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员中心 <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">会员中心</a></li>
		            <li><a href="#">会员中心</a></li>
		            <li><a href="#">会员中心</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="javascript:void(0)" @click="handleSignOutSubmit">用户退出</a></li>
		          </ul>
		        </li>
		    </template>
	      	<template v-else>
	      		<li><a href="javascript:void(0)" @click="handleLogin">登录</a></li>
	       		<li><a href="javascript:void(0)" @click="handleRegister">注册</a></li>
	      	</template>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<div>
		123
	</div>
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
            logout: state => state.mainData.apiUrl.logout,
        }),
    },
    methods: {
      	handleLogin() {
      		this.$store.dispatch('changeLoginDialogVisible') //改变登录组件状态
      	},
      	handleRegister() {
      		this.$store.dispatch('changeRegisterDialogVisible') //改变注册组件状态
      	},
      	 /**
         * [handleSignOutSubmit 用户退出]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-17T16:57:17+0800
         * @return   {[type]}                 [description]
         */
        handleSignOutSubmit(){
        	let _this = this
            var thenFunction = function(Response){
                let dataState = Response.data.state
                if (dataState) {
                    _this.$store.dispatch('authCheckFalse')//关闭登录状态
                }
            }
          	this.$store.dispatch('getHttpNotify',{ url:this.logout, thenFunction})//退出
        },
    }
}
</script>

<style lang="less">
	.navbar-div{
		padding:0 0.20in 0 0.20in;
	}
	@media (max-width: 768px) { 
		.el-dialog--tiny{
			width:80%;
		}
	}
	@media (min-width: 768px) { 
		.el-dialog--tiny{
			width:60%;
		}
	}
	@media (min-width: 992px) { 
		.el-dialog--tiny{
			width:40%;
		}
	}
	@media (min-width: 1200px) { 
		.el-dialog--tiny{
			width:30%;
		}	
	}		

</style>