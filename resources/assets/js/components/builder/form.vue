<template>
    <el-form :model="fromDatas" ref="fromDatas" :rules="datas.rules" :inline="inline" :label-position="position" :label-width="width" :label-suffix="suffix">
        <div class="form-group" v-for="config in datas.datas">
            <builder-hidden     v-if="config.type == 'hidden'"    :datas="config"></builder-hidden>
            <builder-number     v-if="config.type == 'number'"    :datas="fromDatas" :config="config"></builder-number>
            <builder-picture    v-if="config.type == 'picture'"   :datas="fromDatas" :config="config"></builder-picture>
            <builder-select     v-if="config.type == 'select'"    :datas="fromDatas" :config="config"></builder-select>
            <builder-switch     v-if="config.type == 'switch'"    :datas="fromDatas" :config="config"></builder-switch>
            <builder-tags       v-if="config.type == 'tags'"      :datas="fromDatas" :config="config"></builder-tags>
            <builder-text       v-if="config.type == 'text'"      :datas="fromDatas" :config="config"></builder-text>
            <builder-password   v-if="config.type == 'password'"  :datas="fromDatas" :config="config"></builder-password>
            <builder-textarea   v-if="config.type == 'textarea'"  :datas="fromDatas" :config="config"></builder-textarea>
            <builder-upload     v-if="config.type == 'upload'"    :datas="config"></builder-upload>
        </div>
        <el-form-item>
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info" @click="handleSubmit('fromDatas')" :disabled="disabled">确定</button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning"  @click="handleReset">重置</button>
                    </div>
                </div>
        </el-form-item>
    </el-form>
</template>
<style lang="less">
    @media (max-width: 768px) { 
        .el-form {
            width:100%;
        }
    }
    @media (min-width: 768px) { 
        .el-form {
            width:80%;
        }
    }
    @media (min-width: 992px) { 
        .el-form {
            width:70%;
        }
    }
    @media (min-width: 1200px) { 
        .el-form {
            width:60%;
        }
    }   

</style>
<script>
import { mapState,mapMutations } from 'vuex'
import builderText from './packages/form/text.vue'
import builderPassword from './packages/form/password.vue'
import builderHidden from './packages/form/hidden.vue'
import builderNumber from './packages/form/number.vue'
import builderTextarea from './packages/form/textarea.vue'
import builderSelect from './packages/form/select.vue'
import builderTags from './packages/form/tags.vue'
import builderSwitch from './packages/form/switch.vue'
import builderPicture from './packages/form/picture.vue'
import builderUpload from './packages/form/upload.vue'
export default {
    components: {
        builderText,
        builderPassword,
        builderHidden,
        builderNumber,
        builderTextarea,
        builderSelect,
        builderTags,
        builderSwitch,
        builderPicture,
        builderUpload
    },
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
    data() {
        return {
            width:'80px',
            inline:false,
            position:'right',
            suffix:'',
            disabled: false,
            fromDatas:{},
        };
    },
    created() {
        this.compileData();//初始化页面数据
    },
    watch: {
        datas: 'compileData',
    },
    methods:{
        /**
         * [compileData 编译fromDatas数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-04-11T14:25:47+0800
         * @return   {[type]}                 [description]
         */
        compileData(){
            this.setFromRules()
            this.setFromConfig()
            this.setFromDatas()
        },
        /**
         * [setFromRules 设置验证规则]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-04-13T13:54:53+0800
         */
        setFromRules(){
            eval(this.datas.rules)
            let rules = this.datas.rules;
            if (rules!==undefined) {
                for (var name in rules) {
                    for (var key in rules[name]) {
                        let validator = rules[name][key].validator
                        if (validator!==undefined) {
                            rules[name][key].validator = eval(validator) //执行自定义JS规则代码
                        }
                    }
                }
            }
        },
        /**
         * [setFromConfig 设置form配置]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-04-13T13:55:03+0800
         */
        setFromConfig(){
            let config = this.datas.config;
            if (config!==undefined) {
                if (config.width) { this.width = config.width }
                if (config.inline) { this.inline = config.inline }
                if (config.position) { this.position = config.position }
                if (config.suffix) { this.suffix = config.suffix }
            }  
        },
        /**
         * [setFromDatas 设置form渲染数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-04-13T13:55:32+0800
         */
        setFromDatas(){
            let datas = this.datas.datas
            this.fromDatas = {}
            for (var key in datas) {
                var name = datas[key].name
                var value = datas[key].value
                this.fromDatas[name] = value
            }
        },
        handleSubmit(formName){
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    let _this = this;
                    this.disabled = true;
                    let postData = this.fromDatas
                    let thenFunction = (Response) => {
                        setTimeout(() =>  {
                            _this.disabled = false;
                        }, 1000);
                        _this.$store.state.dialogFormVisible = false //关闭dialog页面
                        _this.handleReset()//重新加载页面POST数据
                    }
                    this.$store.dispatch('getHttpNotify',{url:this.datas.apiUrl.submit,postData,thenFunction})     //获取页面数据
                } else {
                    console.log('error submit!! 请检查你的提交信息是否符合规则');
                    return false;
                }
            });
        },
        handleReset() {
            this.$store.dispatch('getCurrentData')//初始化页面数据
            this.disabled = false;
        },
    },
}
</script>
