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
                      :filter-multiple="filterMultiple"
                      :filter-method="column.filterMethod"
                      :filtered-value="column.filteredValue"
                    >
                        <template scope="scope">
                            <template v-if="column.prop=='status'">
                                <el-tag :type="scope.row[column.prop].type">
                                    <i :class="scope.row[column.prop].icon"></i>
                                    {{ scope.row[column.prop].title }}
                                </el-tag>
                            </template>
                            <template v-else-if="column.prop=='rightButton'">
                                <el-button type="info" size="mini"><i class="fa fa-check"></i> 编辑</el-button>
                                <el-button type="warning" size="mini"><i class="fa fa-check"></i> 禁用</el-button>
                                <el-button type="danger" size="mini"><i class="fa fa-check"></i> 删除</el-button>
                                    {{ scope.row[column.prop] }}
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
          rightButtonList:[],
          multipleSelection: []
      }
    },
    created() {
        this.compileRightButton()           //编译右侧按钮
        this.compileTableColumnType()       //编译整个页面属性
    },
    methods: {
        /**
         * [compileRightButton 编译表格右侧按钮]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2016-07-15T17:00:30+0800
         * @return   [type]                   [description]
         */
        compileRightButton(){
            for (var key in this.tableDatas.rightButton) {
                switch (this.tableDatas.rightButton[key].type) {
                    case 'edit':  // 编辑按钮
                        var button ={
                            'title':'编辑',
                            'icon':'<i class="fa fa-edit"></i>',
                            'class':'btn btn-xs btn-info'
                        };
                        this.rightButtonList.push(button);
                    break;
                    // case 'edit':  // 编辑按钮
                    //     var button ={
                    //         'title':'编辑',
                    //         'icon':'<i class="fa fa-edit"></i>',
                    //         'class':'btn btn-xs btn-info'
                    //     };
                    //     this.rightButtonList.push(button);
                    // break;

                }

            }
        },
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
                                        'type':'danger',
                                        'icon':'fa fa-trash',
                                        'title':'删除',
                                    };
                                    break;
                                case 0:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'type':'warning',
                                        'icon':'fa fa-ban',
                                        'title':'禁用',
                                    };
                                    break;
                                case 1:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'type':'success',
                                        'icon':'fa fa-check',
                                        'title':'正常',
                                    };
                                    break;
                                case 2:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'type':'warning',
                                        'icon':'fa fa-eye-slash',
                                        'title':'隐藏',
                                    };
                                    break;
                            }
                            break;
                        case 'btn':
                            this.tableDatas.datas[w][this.tableDatas.column[i].prop] = this.rightButtonList;


                            // console.log(this.tableDatas.datas[w][this.tableDatas.column[i].prop]);
                            break;
                        default:
                    }
                }
            }


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
