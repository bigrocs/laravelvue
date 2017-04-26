<template>
<div class="">
    <div slot="header" class="table-header">
        <div class="row">
            <div class="col-md-8">
                <table-button
                  v-for="(topButton,key) in tableDatas.topButton"
                  :key="key"
                  :buttonDatas="topButton"
                  :multipleSelection="multipleSelection"
                  type="topButton"
                >
                </table-button>
            </div>
            <div class="col-md-4">
                <table-search :datas="tableDatas.search"></table-search>
            </div>
        </div>
    </div>
    <el-table
        :data="tableDatas.datas"
        :stripe="tableDatas.stripe"
        border
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
                    <table-tags v-if="column.type=='tags'" :datas="scope.row[column.prop]" :column="column"></table-tags>
                    <table-picture v-if="column.type=='picture'" :datas="scope.row[column.prop]" :column="column"></table-picture>
                    <template v-if="column.type=='btn'">
                        <table-button
                          v-for="(rightButton,key) in tableDatas.rightButton"
                          :key="key"
                          :buttonDatas="rightButton"
                          :row="scope.row" 
                          :multipleSelection="multipleSelection"
                          size="mini"
                          type="rightButton"
                        >
                        </table-button>
                    </template>
                   <table-scope v-if="!column.type" :datas="scope.row[column.prop]" :column="column"></table-scope>
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

import tablePagination from './packages/pagination.vue'
import tableSearch from './packages/search.vue'

import tableButton from './packages/table/button.vue'
import tableScope from './packages/table/scope.vue'
import tableTags from './packages/table/tags.vue'
import tableStatus from './packages/table/status.vue'
import tablePicture from './packages/table/picture.vue'
export default {
    components: {
        builderForm,

        tablePagination,tableSearch,

        tableScope,tableButton, tableTags,tableStatus,tablePicture
    },
    props: {
        tableDatas: {
            type: Object,
            default: ''
        },
    },
    data() {
      return {
          multipleSelection: [],
      }
    },
    methods: {
        handleSelectionChange(val) {
            this.multipleSelection = val;
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
