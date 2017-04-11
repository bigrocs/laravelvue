<template>
    <el-form :model="fromDatas" :rules="datas.rules" label-width="90px">
        <div class="form-group" v-for="config in datas.datas">
            <builder-hidden     v-if="config.type == 'hidden'"    :datas="config"></builder-hidden>
            <builder-number     v-if="config.type == 'number'"    :datas="config"></builder-number>
            <builder-picture    v-if="config.type == 'picture'"   :datas="config"></builder-picture>
            <builder-select     v-if="config.type == 'select'"    :datas="config"></builder-select>
            <builder-switch     v-if="config.type == 'switch'"    :datas="config"></builder-switch>
            <builder-tags       v-if="config.type == 'tags'"      :datas="config"></builder-tags>
            <builder-text       v-if="config.type == 'text'"      :datas="fromDatas" :config="config"></builder-text>
            <builder-password   v-if="config.type == 'password'"  :datas="config"></builder-password>
            <builder-textarea   v-if="config.type == 'textarea'"  :datas="config"></builder-textarea>
            <builder-upload     v-if="config.type == 'upload'"    :datas="config"></builder-upload>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-8">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info" @click="handleSubmit" :disabled="disabled">确定</button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning"  @click="handleReset">重置</button>
                    </div>
                </div>
            </div>
        </div>
    </el-form>
</template>
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
            disabled: false,
            config:{},
            fromDatas:{}
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
            let datas = this.datas.datas
            this.fromDatas = {}
            for (var key in datas) {
                var name = datas[key].name
                var value = datas[key].value
                this.fromDatas[name] = value
            }
        },
        handleSubmit(){
            let _this = this;
            this.disabled = true;
            let postData = this.fromDatas
            console.log(postData);
            // let postData = new Object();
            // for(var key in this.fromDatas.datas){
            //     postData[this.fromDatas.datas[key].name] = this.fromDatas.datas[key].value
            // }
            let thenFunction = (Response) => {
                setTimeout(() =>  {
                    _this.disabled = false;
                }, 1000);
                _this.$store.state.dialogFormVisible = false //关闭dialog页面
                _this.handleReset()//重新加载页面POST数据
            }
            this.$store.dispatch('getHttpNotify',{url:this.datas.apiUrl.submit,postData,thenFunction})     //获取页面数据
        },
        handleReset() {
            this.$store.dispatch('getCurrentData')//初始化页面数据
            this.disabled = false;
        },
    },
}
</script>
