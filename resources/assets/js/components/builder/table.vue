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
                    <template v-else-if="column.type=='btn'">
                        <table-button
                          v-for="(rightButton,key) in tableDatas.rightButton"
                          :key="key"
                          :buttonDatas="rightButton"
                          :id="scope.row['id']"
                          :status="scope.row['status'].toString()"
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
        <tablePagination :datas="tableDatas.pagination"></tablePagination>
    </div>
</div>
</template>

<script>
import { mapState } from 'vuex'
import builderForm from './form.vue'
import tableTags from './packages/table/tags.vue'
import tableButton from './packages/table/button.vue'
import tableStatus from './packages/table/status.vue'
import tablePagination from './packages/pagination.vue'
export default {
    components: {
        builderForm,
        tableTags,
        tableButton,
        tableStatus,
        tablePagination
    },
    created() {

    },
    data() {
      return {
          inputSearch:'',
          selectSearch:'',
          multipleSelection: [],
      }
    },
    watch: {
        selectSearch:'setSelectSearch',
    },
    computed: {
        ...mapState({
            postData: 'postData',
        }),
    },
    methods: {
        handleSelectionChange(val) {
            this.multipleSelection = val;
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
        width: 1.2in;
     }
    .table-header{
        padding-bottom:15px;
    }
    .table-bottom{
        padding-top:15px;
    }
</style>
