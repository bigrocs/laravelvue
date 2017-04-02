<template>
    <el-form ref="fromDatas" :model="fromDatas" label-width="80px">
        <div class="form-group" v-for="data in fromDatas.datas">
            <builder-hidden     v-if="data.type == 'hidden'"    :datas="data"></builder-hidden>
            <builder-number     v-if="data.type == 'number'"    :datas="data"></builder-number>
            <builder-picture    v-if="data.type == 'picture'"   :datas="data"></builder-picture>
            <builder-select     v-if="data.type == 'select'"    :datas="data"></builder-select>
            <builder-switch     v-if="data.type == 'switch'"    :datas="data"></builder-switch>
            <builder-tags       v-if="data.type == 'tags'"      :datas="data"></builder-tags>
            <builder-text       v-if="data.type == 'text'"      :datas="data"></builder-text>
            <builder-password   v-if="data.type == 'password'"  :datas="data"></builder-password>
            <builder-textarea   v-if="data.type == 'textarea'"  :datas="data"></builder-textarea>
            <builder-upload     v-if="data.type == 'upload'"    :datas="data"></builder-upload>
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
    data() {
        return {
            disabled: false,
        };
    },
    computed: {
        ...mapState({
            postData: 'postData',
        }),
    },
    methods:{
        ...mapMutations([
            'getCurrentData',
        ]),
        handleSubmit(){
            let _this = this;
            this.disabled = true;
            let postData = new Object();
            for(var key in this.fromDatas.datas){
                postData[this.fromDatas.datas[key].name] = this.fromDatas.datas[key].value
            }
            let thenFunction = (Response) => {
                setTimeout(() =>  {
                    _this.disabled = false;
                }, 1000);
                _this.$store.state.dialogFormVisible = false //关闭dialog页面
                _this.handleReset()//重新加载页面POST数据
            }
            this.$store.dispatch('getHttpNotify',{url:this.fromDatas.apiUrl.submit,postData,thenFunction})     //获取页面数据
        },
        handleReset() {
            this.$store.dispatch('getCurrentData')//初始化页面数据
            this.disabled = false;
        },
    },
    props: {
        fromDatas: {
            type: Object,
            default: ''
        },
    },
}
</script>
