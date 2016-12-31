<template>
    <div class="col-md-12">
        <el-card class="box-card">
            <el-table
                :data="tableDatas.datas"
                :stripe="tableDatas.stripe"
                border
                style="width: 100%"
                @selection-change="handleSelectionChange"
            >
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
                      :filter-multiple="filterMultiple"
                      :filter-method="column.filterMethod"
                      :filtered-value="column.filteredValue"
                    >
                    </el-table-column>
                </template>
            </el-table>
        </el-card>
    </div>
</template>

<script>
export default {
    data() {
      return {
          tableDatas: this.datas,
          multipleSelection: []
      }
    },
    created() {
        this.compileTableColumnType()
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
            console.log(this.tableDatas.datas);
        },
        handleSelectionChange(val) {
            console.log(val);
            this.multipleSelection = val;
        }
    },
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
}
</script>
