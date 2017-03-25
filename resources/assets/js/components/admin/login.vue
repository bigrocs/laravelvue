<template>
<!-- Designed with ♥ by Frondor -->
<div class="login-container-fluid">
    <div class="row">
        <div class="faded-bg"></div>
        <div class="hidden-xs col-sm-8 col-md-9">
            <div class="clearfix">
                <div class="hidden-xs" style="margin-top:200px"></div>
                <div class="col-sm-12 col-md-10 col-md-offset-2">
                    <img class="img-responsive pull-left login-logo hidden-xs" src="http://laravel54.dev/vendor/tcg/voyager/assets/images/logo-icon-light.png" alt="Logo Icon">
                    <div class="copy">
                        <h1>LaravelVue</h1>
                        <p>欢迎使用LaravelVue. 这个后台管理系统使用Laravel和Vue构建.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3 login-sidebar">

            <div class="login-logo-container">    
                <img class="img-responsive login-logo" src="http://laravel54.dev/vendor/tcg/voyager/assets/images/logo-icon-light.png" alt="Logo Icon">
            </div>

          <form action="#" method="POST">
            <div class="login-group">      
              <input type="text" name="username" v-model="username" value="" required>
              <span class="login-highlight"></span>
              <span class="login-bar"></span>
              <label><i class="glyphicon glyphicon-user"></i><span class="span-input"> 用户名/手机/邮箱</span></label>
            </div>

            <div class="login-group">      
              <input type="password" name="password" v-model="password" required>
              <span class="login-highlight"></span>
              <span class="login-bar"></span>
              <label><i class="glyphicon glyphicon-lock"></i><span class="span-input"> 登录密码</span></label>
            </div>

            <button type="button" class="btn btn-block login-gradient-button" @click="handleLoginSubmit">
                <span class="signingin hidden"><span class="glyphicon glyphicon-refresh"></span> 登录中...</span>
                <span class="signin">登 录</span>
            </button>
           
          </form>
            
        </div> <!-- .login-sidebar -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
</template>

<script>
import { mapState } from 'vuex'
export default {
    created() {
        this.$store.dispatch('authCheck')//用户认证检查
    },
    data(){
        return{
            username:'',
            password:'',
        }
    },
    computed: {
        ...mapState({
            authStatus: state => state.authStatus,
            login: state => state.mainData.apiUrl.login,
            homeRouterNmae: state => state.mainData.config.homeRouterNmae,
        }),
    },
    watch: {
        authStatus:'toHome',
    },
    methods:{
        /**
         * [toHome 如果登录跳转回home]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-03-25T10:56:56+0800
         * @return   {[type]}                 [description]
         */
        toHome(){
            if (this.authStatus) {
                this.$router.push({name:this.homeRouterNmae})
            }
        },
        /**
         * [handleLoginSubmit 登录获取令牌]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T16:55:45+0800
         * @return   {[type]}                 [description]
         */
        handleLoginSubmit(){
            const postData = {
              'username' : this.username,
              'password' : this.password,
            }
            /**
             * [thenFunction 登录成功后跳转到home页面]
             * @author BigRocs
             * @email    bigrocs@qq.com
             * @DateTime 2017-03-02T16:24:34+0800
             * @param    {[type]}                 Response [请求回参]
             * @return   {[type]}                          [description]
             */
            let _this = this
            var thenFunction = function(Response){
                let dataState = Response.data.state
                if (dataState) {
                    setTimeout(() =>  {
                        _this.$router.push({name:_this.homeRouterNmae})
                    }, 3000);
                }
            }
            this.$store.dispatch('getHttpNotify',{ url:this.login, postData, thenFunction})//登录

        }
    }
}
</script>

<style lang="css">
    .login-container-fluid {
        background-image:url('/assets/apps/img/bg.jpg');
    }
    .login-sidebar:after, .login-gradient-button {
        background: linear-gradient(-135deg, #4cb5ff, #e9721e);
        background: -webkit-linear-gradient(-135deg, #4cb5ff, #e9721e);
    }
    .login-container-fluid {
        margin:0;
        padding:0;
        font-family:Roboto,Source Sans Pro,sans-serif;
        background-size:cover;
        -moz-background-size:cover;
        -ms-background-size:cover;
        -wenkit-background-size:cover;
        background-position:center center;
        background-repeat:no-repeat;
    }

    .login-sidebar {
        min-height:100vh;
        position:relative;
        border-radius:5px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.12), 0 1px 6px 0 rgba(0, 0, 0, 0.12);
        z-index:2;
        padding:0;
        justify-content:center;
    }

    .login-sidebar:after {
        width:100%;
        height:100%;
        position:absolute;
        top:0;
        left:0;
        content:"";
        opacity:0.8;
        z-index:3;
    }


    .login-sidebar > form {
        z-index:4;
        position:relative;
        padding:0px 25px;
        width:100%;
    }

    .login-logo-container {
        text-align:center;
        position:relative;
        z-index: 10;
        opacity:0.8;
    }

    .login-logo{
        height:auto;
        padding:50px 0px;
        max-width: 100px;
        margin: 0 auto;
    }

    .login-group { 
        position:relative; 
        margin-bottom:45px; 
    }
    .login-group input {
        font-size:18px;
        padding:10px 10px 10px 10px;
        display:block;
        width:100%;
        border:none;
        border-bottom:1px solid rgba(255,255,255, 0.3);
        background:none;
        color:#eee;
    }
    .login-group input:focus { outline:none; }

    .login-group label                 {
        color:rgba(255,255,255, 0.5); 
        font-size:18px;
        font-weight:normal;
        position:absolute;
        pointer-events:none;
        left:5px;
        top:5px;
        transition:0.2s ease all; 
        -moz-transition:0.2s ease all; 
        -webkit-transition:0.2s ease all;
    }

    .login-group input:focus ~ label, input:valid ~ label  {
        top:-20px;
        font-size:14px;
        color:rgba(255,255,255, 0.7);
    }

    .login-bar    { position:relative; display:block; width:100%; }
    .login-bar:before, .login-bar:after {
        content:'';
        height:2px; 
        width:0;
        bottom:1px; 
        position:absolute;
        background:rgba(255,255,255, 0.7); 
        transition:0.2s ease all; 
        -moz-transition:0.2s ease all; 
        -webkit-transition:0.2s ease all;
    }
    .login-bar:before {
        left:50%;
    }
    .login-bar:after {
        right:50%; 
    }

    .login-group input:focus ~ .login-bar:before, .login-group input:focus ~ .login-bar:after {
        width:50%;
    }

    .login-highlight {
        position:absolute;
        height:0%; 
        width:100px; 
        top:25%; 
        left:0;
        pointer-events:none;
        opacity:0.5;
    }

    .login-group input:focus ~ .highlight {
        -webkit-animation:inputHighlighter 0.3s ease;
        -moz-animation:inputHighlighter 0.3s ease;
        animation:inputHighlighter 0.3s ease;
    }

    @-webkit-keyframes inputHighlighter {
        from { background:rgba(255,255,255, 0.7); }
        to  { width:0; background:transparent; }
    }
    @-moz-keyframes inputHighlighter {
        from { background:rgba(255,255,255, 0.7); }
        to  { width:0; background:transparent; }
    }
    @keyframes inputHighlighter {
        from { background:rgba(255,255,255, 0.7); }
        to  { width:0; background:transparent; }
    }
    @-moz-keyframes spin {
        from { -moz-transform: rotate(0deg); }
        to { -moz-transform: rotate(359deg); }
    }
    @-webkit-keyframes spin {
        from { -webkit-transform: rotate(0deg); }
        to { -webkit-transform: rotate(359deg); }
    }
    @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(359deg);}
    }

    .span-input{
        margin-left:10px;
        position:relative;
        top:-5px;
    }
    .login-gradient-button {
        display:block;
        text-align:center;
        text-decoration:none;
        color:#eee;
        font-family:Roboto,Source Sans Pro,sans-serif;
        font-weight:100;
        padding:10px;
        border-radius:3px;
        outline:none !important;
        opacity:0.8;
    }
    .login-gradient-button:hover, .login-gradient-button:focus {
        color: #FFF;
        opacity: 1
    }
    .copy {
        width: auto;
        padding: 30px;
    }

    .copy h1 {
        display: inline-block;
        vertical-align: middle;
        color: #fff;
        z-index: 9999;
        position: relative;
        text-transform: uppercase;
        font-size: 50px;
        font-weight: 400;
        top: -10px;
        line-height: 45px;
        margin: 20px 0 0 20px;
    }

    .copy p {
        text-shadow: 0 0 10px #000;
        color: #fff;
        font-size: 20px;
        max-width: 650px;
        opacity: .6;
        position: relative;
        z-index: 99;
        font-weight: 200;
        margin-top: 0;
        left: 25px;
    }
    .faded-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(50, 50, 50, 0.5);
    }
    .glyphicon-refresh {
        -webkit-animation:spin 0.6s infinite linear;
        -moz-animation:spin 0.6s infinite linear;
        animation:spin 0.6s infinite linear;
    }
    .alert-black {
        background: rgba(0, 0, 0, 0.5);
        color: rgb(255, 255, 255);
        position: relative;
        z-index: 10;
        margin: 20px;
    }
</style>