<template>
    <div class="col-md-12">
        <el-tabs type="border-card">
            <template v-for="(group,key) in fromDatas.group">
                <el-tab-pane :label="group">
                    <el-form ref="fromDatas" :model="fromDatas" label-width="80px">
                        <div class="form-group" v-for="data in fromDatas.datas">
                            <template v-if="data.group == key">
                                <div v-if="data.type == 'text'" class="row">
                                    <builder-text :datas="data"></builder-text>
                                </div>
                                <div v-if="data.type == 'textarea'" class="row">
                                    <builder-textarea :datas="data"></builder-textarea>
                                </div>
                                <div v-if="data.type == 'number'" class="row">
                                    <builder-number :datas="data"></builder-number>
                                </div>
                                <div v-if="data.type == 'switch'" class="row">
                                    <builder-switch :datas="data"></builder-switch>
                                </div>
                                <div v-if="data.type == 'picture'" class="row">
                                    <builder-picture :datas="data"></builder-picture>
                                </div>
                                <div v-if="data.type == 'upload'" class="row">
                                    <builder-upload :datas="data"></builder-upload>
                                </div>
                            </template>
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
                    </el-form>
                </el-tab-pane>
            </template>
        </el-tabs>
    </div>
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
            fromDatas: this.datas,
            disabled: false,
        };
    },
    methods:{
        handleSubmit(){
            this.disabled = true;
            this.$http.patch(this.fromDatas.url, this.fromDatas.datas).then(function (Response) {
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
        datas: {
            type: Object,
            default: ''
        },
    },
}
</script>
