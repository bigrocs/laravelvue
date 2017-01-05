<template>
<div class="row">
    <div class="col-md-12">
        <el-card class="box-card" v-if="datas.tabs == null">
            <template v-for="data in datas" >
                <builder-form   v-if="data.type == 'form'"      :fromDatas="data"></builder-form>
                <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
            </template>
        </el-card>
        <el-tabs type="border-card" @tab-click="handleTabsClick" v-else>
            <el-tab-pane v-for="(tabs,key) in datas.tabs" :label="tabs" >
                <template v-for="data in datas" >
                    <builder-form   v-if="data.type == 'form'"      :fromDatas="data"></builder-form>
                    <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
                </template>
            </el-tab-pane>
        </el-tabs>
</div>
</template>
<script>
import builderForm from './form.vue'
import builderTable from './table.vue'
export default {
    components: {
        builderForm,
        builderTable
    },
    created() {
        this.getData()
    },
    data() {
        return {
            datas: {}
        };
    },
    watch: {
        $route: 'getData'
    },
    methods: {
        handleTabsClick(tab, event){
            this.$http.post(this.$store.state.CurrentApiUrl,{'tabsId':tab.index}).then((Response) => {
                this.$set(this, 'datas', Response.data) //获取页面数据赋值
            })
        },
        /**
         * 获取页面数据
         */
        getData() {
            this.$store.commit('getCurrentApiUrl', this.$route.name) //当去当前路由API地址 赋值this.$store.state.CurrentUrl
            this.$http.post(this.$store.state.CurrentApiUrl).then((Response) => {
                this.$set(this, 'datas', Response.data) //获取页面数据赋值
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
