<template>
<div class="row">
    <div class="col-md-12">
        <el-card class="box-card" v-if="datas.tabs == null">
            <template v-for="data in datas" >
                <builder-form   v-if="data.type == 'form'"      :fromDatas="data"></builder-form>
                <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
            </template>
        </el-card>
        <el-tabs type="border-card" v-model="activeName" @tab-click="handleTabsClick" v-else>
            <el-tab-pane v-for="(tabs,key) in datas.tabs" :label="tabs">
                <template v-for="data in datas" >
                    <builder-form   v-if="data.type == 'form'"      :fromDatas="data"></builder-form>
                    <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
                </template>
            </el-tab-pane>
        </el-tabs>
</div>
</template>
<script>
import { mapState } from 'vuex'
import builderForm from './form.vue'
import builderTable from './table.vue'
export default {
    components: {
        builderForm,
        builderTable
    },
    created() {
        this.getData();
    },
    data() {
        return {
            datas: {},
            activeName: '',
        };
    },
    watch: {
        $route: 'getData',
        dialogFormVisible:'watchDialogFormVisible',
    },
    computed: mapState([
      // 映射 this.count 为 store.state.count
      'dialogFormVisible'
    ]),
    methods: {
        handleTabsClick(tab, event){
            this.$http.post(this.$store.state.CurrentApiUrl,{'tabsId':tab.index}).then((Response) => {
                this.$set(this, 'datas', Response.data) //获取页面数据赋值
            })
        },
        /**
         * 减少请求次数
         * 只有状态改变为关闭时才执行(form表单提交后)
         * 实现form提交新数据后 更新table数据
         */
        watchDialogFormVisible(){
            if (!this.dialogFormVisible) {this.getData()}
        },
        /**
         * 获取页面数据
         */
        getData() {
            this.activeName = 0;//初始化tabs选项属性
            this.$store.commit('getCurrentApiUrl', this.$route.name) //当去当前路由API地址 赋值this.$store.state.CurrentUrl
            this.$http.post(this.$store.state.CurrentApiUrl).then((Response) => {
                this.$set(this, 'datas', Response.data) //获取页面数据赋值
                if(this.datas.title){
                    document.title = this.datas.title//设置页面标题
                }
                console.log(this.datas);
            })
        }
    }

};
</script>
<style>
.check-tip {
    color: #95A5A6;
}
</style>
