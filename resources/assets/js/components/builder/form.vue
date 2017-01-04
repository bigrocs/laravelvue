<template>
    <div class="col-md-12">
        <el-card class="box-card" v-if="fromDatas.tabs == null">
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
        <el-tabs type="border-card" @tab-click="handleTabsClick" v-else>
            <template v-for="(tabs,key) in fromDatas.tabs">
                <el-tab-pane :label="tabs">
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
                </el-tab-pane>
            </template>
        </el-tabs>
    </div>
</template>
<script>
import builderFormindex from './packages/index.vue'
export default {
    components: {
        builderFormindex,
    },
    data() {
        return {
            fromDatas: this.datas,
            disabled: false,
        };
    },
    methods:{
        handleTabsClick(tab, event){
            this.$http.post(this.$store.state.CurrentApiUrl,{'tabsId':tab.index}).then((Response) => {
                this.$set(this, 'fromDatas', Response.data.form) //获取页面数据赋值
            })
        },
        handleSubmit(){
            this.disabled = true;
            const data = [];
            for(var key in this.fromDatas.datas){
                data[key] = {
                    'id': this.fromDatas.datas[key].id,
                    'value': this.fromDatas.datas[key].value,
                }
            }
            this.$http.patch(this.fromDatas.apiUrl.urlSubmit, data).then(function (Response) {
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
