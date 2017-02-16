<template>
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Laravel</b>VUE</a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">登录管理员后台</p>

        <form action="#" method="post">
          <div class="form-group has-feedback">
              <el-input type="username" v-model="username" name="username" placeholder="用户名/手机/邮箱"></el-input>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <el-input type="password" v-model="password" name="password" placeholder="密码"></el-input>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> 记住我
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="button" class="btn btn-primary btn-block btn-flat" @click="handleLoginSubmit">登录</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
            Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
            Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

        <a href="#">忘记密码</a><br>

      </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            username:'',
            password:'',
        }
    },
    created() {

    },
    methods:{
        handleLoginSubmit(){
            const postData = {
              'grant_type' : 'password',
              'client_id' : '2',
              'client_secret' : 'aqTidkQScKa6HFVoDrNVqt8JZqqsdWEssYersdLY',
              'username' : this.username,
              'password' : this.password,
              'scope' : '',
            }
            const authUser = {}
            axios.post('/oauth/token',postData).then((Response)=>{
              if (Response.status === 200) {
                authUser.accessToken = Response.data.access_token
                authUser.refreshToken = Response.data.refresh_token
                window.localStorage.setItem('authUser',JSON.stringify(authUser))
              }
            })
        }
    }
}
</script>

<style lang="css">
    body{
        background:#d2d6de !important;
    }
</style>
