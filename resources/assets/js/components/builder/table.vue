<template>
<div class="">
    <div slot="header" class="table-header">
        <div class="row">
            <div class="col-md-8">
                <table-button
                  v-for="(topButton,key) in tableDatas.topButton"
                  :key="key"
                  :buttonDatas="topButton"
                  :apiUrl="tableDatas.apiUrl"
                  :multipleSelection="multipleSelection"
                  type="topButton"
                >
                </table-button>
            </div>
            <div class="col-md-4">
                <el-input
                    v-if="tableDatas.search.title"
                    v-model="inputSearch"
                    :placeholder="tableDatas.search.title"
                    @keyup.enter.native="handleInputConfirm"
                    @blur="handleInputConfirm"
                >
                    <el-select v-if="tableDatas.search.select" v-model="selectSearch" slot="prepend" placeholder="请选择">
                        <el-option v-for="(label, value) in tableDatas.search.select"  :key="value" :label="label" :value="value"></el-option>
                    </el-select>
                    <el-button slot="append" icon="search" @click="handleInputConfirm"></el-button>
                </el-input>
            </div>
        </div>
    </div>
    <el-table
        :data="tableDatas.datas"
        :stripe="tableDatas.stripe"
        border
        style="width: 100%"
        @selection-change="handleSelectionChange">
        <el-table-column
            type="selection"
            width="55">
        </el-table-column>
        <template v-for="column in tableDatas.column">
            <el-table-column
                :type="column.type"
                :column-key="column.columnKey"
                :label="column.label"
                :prop="column.prop"
                :width="column.width"
                :min-width="column.minWidth"
                :fixed="column.fixed"
                :render-header="column.renderHeader"
                :sortable="column.sortable"
                :sort-method="column.sortMethod"
                :resizable="column.resizable"
                :formatter="column.formatter"
                :show-overflow-tooltip="column.showOverflowTooltip"
                :align="column.align"
                :header-align="column.headerAlign"
                :class-name="column.className"
                :reserve-selection="column.reserveSelection"
                :filters="column.filters"
                :filter-multiple="column.filterMultiple"
                :filter-method="column.filterMethod"
                :filtered-value="column.filteredValue"
            >
                <template scope="scope">
                    <table-status v-if="column.type=='status'" :datas="scope.row[column.prop]"></table-status>
                    <table-tags v-else-if="column.type=='tags'" :datas="scope.row[column.prop]" :config="column.tags"></table-tags>
                    <template v-else-if="column.prop=='rightButton'">
                        <table-button
                          v-for="(rightButton,key) in tableDatas.rightButton"
                          :key="key"
                          :buttonDatas="rightButton"
                          :id="scope.row['id']"
                          :status="scope.row[statusProp].toString()"
                          :apiUrl="tableDatas.apiUrl"
                          :multipleSelection="multipleSelection"
                          size="mini"
                          type="rightButton"
                        >
                        </table-button>
                    </template>
                    <template v-else>
                        {{ scope.row[column.prop] }}
                    </template>
                </template>
            </el-table-column>
        </template>
    </el-table>
    <div class="table-bottom">
        <el-pagination
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :page-sizes="this.tableDatas.pagination.pageSizes"
            :page-size="tableDatas.pagination.pageSize"
            :layout="tableDatas.pagination.layout"
            :total="tableDatas.pagination.total">
        </el-pagination>
    </div>
</div>
</template>

<script>
import { mapState } from 'vuex'
import builderForm from './form.vue'
import tableTags from './packages/table/tags.vue'
import tableButton from './packages/table/button.vue'
import tableStatus from './packages/table/status.vue'
export default {
    components: {
        builderForm,
        tableTags,
        tableButton,
        tableStatus
    },
    created() {
        // this.compileTopButton()             //编译顶部按钮
        // this.compileRightButton()           //编译右侧按钮
        this.compileTableColumnType()       //编译整个页面属性
    },
    data() {
      return {
          // topButtonList:[],
          rightButtonList:[],
          statusProp:null,
          inputSearch:'',
          selectSearch:'',
          multipleSelection: [],
          button:{
              'add':{
                  'title':'新增',
                  'icon':'fa fa-plus',
                  'type':'primary',
                  'method':'add'
              },
              'edit':{
                  'title':'编辑',
                  'icon':'fa fa-edit',
                  'type':'info',
                  'method':'edit'
              },
              'resume':{
                  'title':'启用',
                  'icon':'fa fa-check',
                  'type':'success',
                  'method':'resume'
              },
              'forbid':{
                  'title':'禁用',
                  'icon':'fa fa-ban',
                  'type':'warning',
                  'method':'forbid'
              },
              'display':{
                  'title':'显示',
                  'icon':'fa fa-check',
                  'type':'success',
                  'method':'display'
              },
              'hide':{
                  'title':'隐藏',
                  'icon':'fa fa-eye-slash',
                  'type':'warning',
                  'method':'hide'
              },
              'delete':{
                  'title':'删除',
                  'icon':'fa fa-trash',
                  'type':'danger',
                  'method':'delete'
              },
          }
      }
    },
    watch: {
        tableDatas: 'compileTableColumnType',
        selectSearch:'setSelectSearch',
    },
    computed: {
        ...mapState({
            postData: 'postData',
        }),
    },
    methods: {
        /**
         * [compileTableColumnType 根据表格标题字段指定类型编译列表数据]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2016-07-07T10:02:07+0800
         * @param    [type]                   $tableArray    [编译前的数组]
         * @return   [type]                                  [编译后的数组]
         */
        compileTableColumnType(){
            let pageSizes = this.tableDatas.pagination.pageSizes
            let pageSize = this.tableDatas.pagination.pageSize
            for(var key in pageSizes){
                pageSizes[key] = Number(pageSizes[key])
            }
            this.tableDatas.pagination.pageSizes = pageSizes;
            this.tableDatas.pagination.pageSize = Number(pageSize)

            for (var w = 0; w < this.tableDatas.datas.length; w++) {
                for (var i = 0; i < this.tableDatas.column.length; i++) {
                    switch(this.tableDatas.column[i].type)
                    {
                        case 'status':
                            this.statusProp = this.tableDatas.column[i].prop;
                                break;

                    }
                }
            }
        },
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
        /**
         * [handleSizeChange 设置每页显示数量并获取数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:48:22+0800
         * @param    {[type]}                 val [description]
         * @return   {[type]}                     [description]
         */
        handleSizeChange(val){
            this.$store.state.postData.pageSize = val;
            this.$store.dispatch('getCurrentData',this.postData)//根据pageSize获取数据
        },
        /**
         * [handleCurrentChange 根据页码获取页面数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:47:59+0800
         * @param    {[type]}                 val [description]
         * @return   {[type]}                     [description]
         */
        handleCurrentChange(val) {
            this.$store.state.postData.page = val;
            this.$store.dispatch('getCurrentData',this.postData)//根据page获取数据
        },
        /**
         * [setSelectSearch 选择搜索数据列]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:47:29+0800
         */
        setSelectSearch(){
            this.$store.state.postData.selectSearch = this.selectSearch;
        },
        /**
         * [handleInputConfirm 根据搜索获取数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:46:59+0800
         * @return   {[type]}                 [description]
         */
        handleInputConfirm(){
            this.$store.state.postData.inputSearch = this.inputSearch;
            this.$store.dispatch('getCurrentData',this.postData)//根据inputSearch获取数据
        }
    },
    props: {
        tableDatas: {
            type: Object,
            default: ''
        },
    },
}
</script>
<style lang="css">
    .el-select .el-input {
        width: 110px;
     }
    .table-button-min{
        margin-bottom:5px !important;
        margin-left:0px !important;
        margin-right:5px !important;
    }
    .table-header{
        padding-bottom:15px;
    }
    .table-bottom{
        padding-top:15px;
    }
</style>
