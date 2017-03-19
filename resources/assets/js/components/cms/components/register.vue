<template>
	<el-dialog title="用户注册" v-model="$store.state.registerDialogVisible" size="tiny">
      <el-tabs v-model="activeName" type="card">
        <el-tab-pane label="用户名注册" name="username">
          <div>
              <el-input v-model="postData.username" placeholder="请输入用户名">
                <template slot="prepend">用 户 名</template>
              </el-input>
          </div>
          <div :style="divMargin">
              <el-input v-model="postData.password" type="password" placeholder="请输入密码">
                <template slot="prepend">设置密码</template>
              </el-input>
          </div>
           <div :style="divMargin">
              <el-input v-model="postData.checkPassword" type="password" placeholder="请再次输入密码">
                <template slot="prepend">确认密码</template>
              </el-input>
          </div>
          <div :style="divMargin">
              <span>点击注册表示同意<a href="javascript:void(0)">用户协议</a></span>
          </div>
          <div :style="divMargin">
              <el-button type="primary" size="large" :style="buttonStyle" @click="submitForm()">注 册</el-button>
          </div>
        </el-tab-pane>
        <el-tab-pane label="邮箱注册" name="email">
          <div>
              <el-input v-model="postData.email" placeholder="请输入邮箱地址">
                <template slot="prepend">邮箱地址</template>
              </el-input>
          </div>
          <div :style="divMargin">
              <el-input v-model="postData.verify" placeholder="请输入验证码">
                <template slot="append"><el-button  @click="">发送邮箱验证码</el-button></template>
              </el-input>
          </div>
          <div :style="divMargin">
              <el-input v-model="postData.password" type="password" placeholder="请输入密码">
                <template slot="prepend">设置密码</template>
              </el-input>
          </div>
           <div :style="divMargin">
              <el-input v-model="postData.checkPassword" type="password" placeholder="请再次输入密码">
                <template slot="prepend">确认密码</template>
              </el-input>
          </div>
          <div :style="divMargin">
              <span>点击注册表示同意<a href="javascript:void(0)">用户协议</a></span>
          </div>
          <div :style="divMargin">
              <el-button type="primary" size="large" :style="buttonStyle" @click="">注 册</el-button>
          </div>
        </el-tab-pane>
        <el-tab-pane label="手机号注册" name="mobile">
          <div>
              <el-input v-model="postData.mobile" placeholder="请输入手机号码">
                <template slot="prepend">手机号码</template>
              </el-input>
          </div>
          <div :style="divMargin">
              <el-input v-model="postData.verify" placeholder="请输入验证码">
                <template slot="append"><el-button  @click="">发送短信验证码</el-button></template>
              </el-input>
          </div>
          <div :style="divMargin">
              <el-input v-model="postData.password" type="password" placeholder="请输入密码">
                <template slot="prepend">设置密码</template>
              </el-input>
          </div>
           <div :style="divMargin">
              <el-input v-model="postData.checkPassword" type="password" placeholder="请再次输入密码">
                <template slot="prepend">确认密码</template>
              </el-input>
          </div>
          <div :style="divMargin">
              <span>点击注册表示同意<a href="javascript:void(0)">用户协议</a></span>
          </div>
          <div :style="divMargin">
              <el-button type="primary" size="large" :style="buttonStyle" @click="">注 册</el-button>
          </div>
        </el-tab-pane>
      </el-tabs>

	</el-dialog>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data() {
      	return {
            activeName:'username',
            postData:
            {
              username:'',
              email:'',
              mobile:'',
              password:'',
              checkPassword:'',
              verify:''
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
    methods: {
      	handleLoginRegister() {
      		  this.$store.dispatch('changeRegisterDialogVisible') //改变注册组件状态
      	}
    }
}
</script>