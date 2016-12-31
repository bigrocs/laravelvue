<template>
    <div class="col-md-12">
        <el-card class="box-card" v-if="fromDatas.group == null">
            <el-form ref="fromDatas" :model="fromDatas" label-width="80px">
                <div class="form-group" v-for="data in fromDatas.datas">
                    <builder-formindex :datas="data"></builder-formindex>
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
        </el-card>
        <el-tabs type="border-card" v-else>
            <template v-for="(group,key) in fromDatas.group">
                <el-tab-pane :label="group">
                    <el-form ref="fromDatas" :model="fromDatas" label-width="80px">
                        <div class="form-group" v-for="data in fromDatas.datas">
                            <template v-if="data.group == key">
                                <builder-formindex :datas="data"></builder-formindex>
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
import builderFormindex from './packages/index.vue'
// import builderText from './packages/text.vue'
// import builderTextarea from './packages/textarea.vue'
// import builderNumber from './packages/number.vue'
// import builderSwitch from './packages/switch.vue'
// import builderPicture from './packages/picture.vue'
// import builderUpload from './packages/upload.vue'
export default {
    components: {
        builderFormindex,
        // builderText,
        // builderTextarea,
        // builderNumber,
        // builderSwitch,
        // builderPicture,
        // builderUpload
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
