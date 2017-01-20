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
                <template v-for="data in currentData" >
                    <builder-form   v-if="data.type == 'form'"      :fromDatas="data"></builder-form>
                    <builder-table  v-if="data.type == 'table'"     :tableDatas="data"></builder-table>
                </template>
            </el-tab-pane>
        </el-tabs>
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
            datas: {},
            tabIndex: '',
        };
    },
    watch: {
        $route: 'getData',
        dialogFormVisible:'watchDialogFormVisible',
    },
    computed: {
        ...mapState([
          'dialogFormVisible',
          'currentApiUrl',
          'currentData'
        ]),
    },
    methods: {
        ...mapMutations([
            'getCurrentApiUrl',
            'getCurrentData'
        ]),
        handleTabsClick(tab, event){
            this.tabIndex = tab.index;
            this.getCurrentData({'tabsId':this.tabIndex})//获取页面信息
        },
        /**
         * 减少请求次数
         * 只有状态改变为关闭时才执行(form表单提交后)
         * 实现form提交新数据后 更新table数据
         */
        watchDialogFormVisible(){
            if (!this.dialogFormVisible) {
                this.getCurrentData({'tabsId':this.tabIndex})//获取页面信息
            }
        },
        /**
         * 获取页面数据
         */
        getData() {
            this.tabIndex = 0;//初始化tabs选项属性
            this.getCurrentApiUrl (this.$route.name)//初始化当前路由URL
            this.getCurrentData()//获取页面信息
        }
    }

};
</script>
<style>
.check-tip {
    color: #95A5A6;
}
</style>
