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
                        <template scope="scope">
                            <template v-if="column.prop=='status'">
                                <span class="label label-sm"
                                    v-bind:class="scope.row[column.prop].type"
                                    :title="scope.row[column.prop].title"
                                >
                                    <i :class="scope.row[column.prop].icon"></i>
                                    {{ scope.row[column.prop].title }}
                                </span>
                            </template>
                            <template v-else>
                                {{ scope.row[column.prop] }}
                            </template>
                        </template>
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
            for (var w = 0; w < this.tableDatas.datas.length; w++) {
                for (var i = 0; i < this.tableDatas.column.length; i++) {
                    switch(this.tableDatas.column[i].type)
                    {
                        case 'status':
                            switch(this.tableDatas.datas[w][this.tableDatas.column[i].prop]){
                                case -1:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'type':'label-danger',
                                        'icon':'fa fa-trash',
                                        'title':'删除',
                                    };
                                    break;
                                case 0:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'type':'label-warning',
                                        'icon':'fa fa-ban',
                                        'title':'禁用',
                                    };
                                    break;
                                case 1:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'type':'label-success',
                                        'icon':'fa fa-check',
                                        'title':'正常',
                                    };
                                    break;
                                case 2:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'type':'label-warning',
                                        'icon':'fa fa-eye-slash',
                                        'title':'隐藏',
                                    };
                                    break;
                            }
                            break;
                        case 2:
                          break;
                        default:
                    }
                }
            }


        },
        handleSelectionChange(val) {
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
