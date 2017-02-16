<template>
<div class="row">
    <div class="col-md-12">
        <el-card class="box-card" v-if="currentData.tabs == null">
            <template v-for="data in currentData" >
                <builder-form   v-if="data.type == 'form'"      :fromDatas="data"></builder-form>
                <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
            </template>
        </el-card>
        <el-tabs type="border-card" v-model="tabIndex" @tab-click="handleTabsClick" v-else>
            <el-tab-pane v-for="(tabs,key) in currentData.tabs" :label="tabs">
                <template v-if="tabIndex == key" v-for="data in currentData" >
                    <builder-form   v-if="data.type == 'form'"      :fromDatas="data"></builder-form>
                    <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
                </template>
            </el-tab-pane>
        </el-tabs>
    </div>
</div>
</template>
<script>
import { mapState,mapMutations } from 'vuex'
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
            datas: {}
        };
    },
    watch: {
        $route: 'getData',
        dialogFormVisible:'watchDialogFormVisible',
    },
    computed: {
        ...mapState({
            dialogFormVisible: 'dialogFormVisible',
            currentData: 'currentData',
            postData: 'postData',
            tabIndex: state => state.postData.tabIndex,
        }),
    },
    methods: {
        /**
         * [handleTabsClick 切换tabs重新获取页面数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:19:09+0800
         * @param    {[type]}                 tab   [description]
         * @param    {[type]}                 event [description]
         * @return   {[type]}                       [description]
         */
        handleTabsClick(tab, event){
            this.$store.dispatch('initPostData')//初始化页面POST数据
            this.$store.dispatch('setTabIndex',tab.index)//初始化页面POST数据
            this.$store.dispatch('getCurrentData',this.postData)//初始化页面POST数据
        },

        /**
         * [watchDialogFormVisible 实现form提交新数据后 更新table数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:20:52+0800
         * @return   {[type]}                 [description]
         * 减少请求次数
         * 只有状态改变为关闭时才执行(form表单提交后)
         */
        watchDialogFormVisible(){
            if (!this.dialogFormVisible) {
                this.$store.dispatch('getCurrentData',this.postData)//初始化页面POST数据
            }
        },

        /**
         * [getData 获取页面数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:19:28+0800
         * @return   {[type]}                 [description]
         */
        getData() {
            this.$store.dispatch('initPostData')//初始化页面POST数据
            this.$store.dispatch('getCurrentApiUrl',this.$route.name)//初始化当前路由URL
            this.$store.dispatch('getCurrentData')//初始化页面POST数据
        }
    }

};
</script>
<style>
.check-tip {
    color: #95A5A6;
}
</style>
