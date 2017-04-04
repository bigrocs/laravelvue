<template>
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                <el-card class="box-card" v-if="currentData.tabs == null">
                    <template v-for="data in currentData" >
                        <builder-form   v-if="data.type == 'form'"      :datas="data"></builder-form>
                        <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
                    </template>
                </el-card>
                <el-tabs type="card" v-model="tabIndex" @tab-click="handleTabsClick" v-else>
                    <el-tab-pane v-for="(tabs,key) in currentData.tabs" :key="key" :label="tabs">
                        <template v-if="tabIndex == key" v-for="data in currentData" >
                            <builder-form   v-if="data.type == 'form'"      :datas="data"></builder-form>
                            <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
                        </template>
                    </el-tab-pane>
                </el-tabs>
            </div>
        </div>
    </div>
    <dialog-form></dialog-form>
</div>
</template>
<script>
import { mapState } from 'vuex'
import builderForm from './form.vue'
import builderTable from './table.vue'
import dialogForm from './packages/dialogForm.vue'
export default {
    components: {
        builderForm,
        builderTable,
        dialogForm
    },
    created() {
        this.getData();//初始化页面数据
    },
    watch: {
        $route: 'getData',
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
            this.$store.dispatch('initPostData')//初始化POST数据
            this.$store.dispatch('setPostData',{tabIndex:tab.index})//设置post数据
            this.$store.dispatch('getCurrentData',this.postData)//重新获取页面数据
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
            this.$store.dispatch('setCurrentApiUrl',this.$route.meta.apiUrl)//初始化当前路由URL
            this.$store.dispatch('getCurrentData')//初始化页面POST数据
        }
    }

};
</script>
<style lang="css">
.check-tip {
    color: #95A5A6;
}
</style>
<style lang="less">
    // font-awesome字体
    @import "~font-awesome/less/font-awesome";
</style>
<style lang="scss">
    // bootstrap
    @import "resources/assets/sass/bootstrap";
    // ionicons 字体
    $ionicons-font-path: "~ionicons/dist/fonts";
    @import "~ionicons/dist/scss/ionicons.scss";
</style>
