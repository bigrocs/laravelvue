<template>
	<el-dialog title="用户登录" v-model="$store.state.loginDialogVisible" size="tiny">
      <el-form :model="postData" :rules="rules" ref="postData" >
          <el-form-item prop="username">
              <el-input v-model="postData.username" placeholder="邮箱/手机号/用户名">
                <template slot="prepend">账号</template>
              </el-input>
          </el-form-item>
          <el-form-item prop="password">
              <el-input v-model="postData.password" type="password" placeholder="请输入密码"  @keyup.enter.native="submitForm('postData')">
                <template slot="prepend">密码</template>
              </el-input>
          </el-form-item>
          <el-form-item>
              <el-checkbox v-model="rememberLogin">记住密码</el-checkbox>
          </el-form-item>
          <el-form-item>
              <el-button type="primary" :style="buttonStyle" @click="submitForm('postData')">登 录</el-button>
          </el-form-item>
      </el-form>
	</el-dialog>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data() {
        var validateUsername = (rule, value, callback) => {
          if (value === '') {
            callback(new Error('请输入邮箱/手机号/用户名'));
          } else {
            callback();
          }
        };
        var validatePassword = (rule, value, callback) => {
          if (value === '') {
            callback(new Error('请输入密码'));
          } else {
            callback();
          }
        };
      	return {
            rules: {
              username: [
                { validator: validateUsername, trigger: 'blur' }
              ],
              password: [
                { validator: validatePassword, trigger: 'blur' }
              ]
            },
            postData:
            {
              username:'',
              password:''
            },
            rememberLogin:true,
            divMargin: {
              marginTop: '15px'
            },
            buttonStyle:{
              width:'100%'
            }
      	};
    },
    computed: {
        ...mapState({
            loginUrl: state => state.mainData.apiUrl.login,
        }),
    },
    methods: {
        demo(){
          console.log('test');
        },
        submitForm(formName) {
          this.$refs[formName].validate((valid) => {
            if (valid) {
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
                      _this.$store.dispatch('authCheckTrue')//改变登录状态
                      setTimeout(() =>  {
                          _this.$store.dispatch('changeLoginDialogVisible') //开启变登录注册组件
                      }, 3000);
                  }
              }
              this.$store.dispatch('getHttpNotify',{ url:this.loginUrl, postData:this.postData, thenFunction})//登录
            } else {
              console.log('error submit!!');
              return false;
            }
          });
        }
    }
}
</script>