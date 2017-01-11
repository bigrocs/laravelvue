<template>
    <el-form ref="fromDatas" :model="fromDatas" label-width="80px">
        <div class="form-group" v-for="data in fromDatas.datas">
            <builder-text       v-if="data.type == 'text'"      :datas="data"></builder-text>
            <builder-textarea   v-if="data.type == 'textarea'"  :datas="data"></builder-textarea>
            <builder-number     v-if="data.type == 'number'"    :datas="data"></builder-number>
            <builder-switch     v-if="data.type == 'switch'"    :datas="data"></builder-switch>
            <builder-picture    v-if="data.type == 'picture'"   :datas="data"></builder-picture>
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
import builderText from './packages/text.vue'
import builderTextarea from './packages/textarea.vue'
import builderNumber from './packages/number.vue'
import builderSwitch from './packages/switch.vue'
import builderPicture from './packages/picture.vue'
import builderUpload from './packages/upload.vue'
export default {
    components: {
        builderText,
        builderTextarea,
        builderNumber,
        builderSwitch,
        builderPicture,
        builderUpload
    },
    data() {
        return {
            disabled: false,
        };
    },
    methods:{
        handleSubmit(){
            this.disabled = true;
            const data = [];
            for(var key in this.fromDatas.datas){
                data[key] = {
                    'id': this.fromDatas.datas[key].id,
                    'name': this.fromDatas.datas[key].name,
                    'value': this.fromDatas.datas[key].value,
                }
            }
            this.$http.post(this.fromDatas.apiUrl.urlSubmit, data).then(function (Response) {
                if (Response.data.duration==null) {
                    Response.data.duration = 4500;
                }
                this.$notify({
                  title: Response.data.title,
                  message: Response.data.message,
                  type: Response.data.type,
                  iconClass: Response.data.iconClass,
                  customClass: Response.data.customClass,
                  duration: Response.data.duration,
                  onClose: Response.data.onClose,
                  offset: Response.data.offset,
                });
                setTimeout(() =>  {
                    this.disabled = false;
                }, 1000);
            });
        },
        handleReset() {
            console.log('from表单重置功能-待开发！');
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
