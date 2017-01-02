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
                                <template v-for="rightButton in scope.row[column.prop]">
                                    <el-button :type="rightButton.class" size="mini"  @click="handleClick(rightButton.method,scope.$index, scope.row)">
                                        <i :class="rightButton.icon"></i>
                                        {{rightButton.title}}
                                    </el-button>
                                </template>
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
          statusProp:null,
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
                            'icon':'fa fa-edit',
                            'class':'info',
                            'method':'edit'
                        };
                        this.rightButtonList.push(button);
                        break;
                    case 'forbid':  //改变记录状态按钮，会更具数据当前的状态自动选择应该显示启用/禁用
                        var button ={
                            0:{
                                'title':'启用',
                                'icon':'fa fa-check',
                                'class':'success',
                                'method':'enable'
                            },
                            1:{
                                'title':'禁用',
                                'icon':'fa fa-ban',
                                'class':'warning',
                                'method':'disable'
                            },
                            'type':'forbid',
                        };
                        this.rightButtonList.push(button);
                        break;
                    case 'delete':  // 删除按钮
                        var button ={
                            'title':'删除',
                            'icon':'fa fa-trash',
                            'class':'danger',
                            'method':'delete'
                        };
                        this.rightButtonList.push(button);
                        break;
                    default:
                        break;
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
                            this.statusProp = this.tableDatas.column[i].prop;
                            switch(this.tableDatas.datas[w][this.tableDatas.column[i].prop]){
                                case -1:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'value':-1,
                                        'type':'danger',
                                        'icon':'fa fa-trash',
                                        'title':'删除',
                                    };
                                    break;
                                case 0:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'value':0,
                                        'type':'warning',
                                        'icon':'fa fa-ban',
                                        'title':'禁用',
                                    };
                                    break;
                                case 1:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'value':1,
                                        'type':'success',
                                        'icon':'fa fa-check',
                                        'title':'正常',
                                    };
                                    break;
                                case 2:
                                    this.tableDatas.datas[w][this.tableDatas.column[i].prop] = {
                                        'value':2,
                                        'type':'warning',
                                        'icon':'fa fa-eye-slash',
                                        'title':'隐藏',
                                    };
                                    break;
                            }
                            break;
                        case 'btn':
                            var rightButtonData = [];
                            for (var key in this.rightButtonList) {
                                switch (this.rightButtonList[key].type) {
                                    case 'forbid':
                                        var statusValue = this.tableDatas.datas[w][this.statusProp].value;
                                        rightButtonData.push(this.rightButtonList[key][statusValue]);
                                        break;
                                    default:
                                        rightButtonData.push(this.rightButtonList[key]);
                                }
                            }
                            this.tableDatas.datas[w][this.tableDatas.column[i].prop] = rightButtonData;
                            break;
                        default:
                    }
                }
            }


        },
        handleClick(method,index, row) {
            switch (method) {
                case 'edit':
                    this.handleEdit(index, row)
                    break;
                case 'enable':
                    this.handleEnable(index, row)
                    break;
                case 'disable':
                    this.handleDisable(index, row)
                    break;
                case 'delete':
                    this.handleDelete(index, row)
                    break;
                default:
            }
        },
        handleEdit(index, row) {
            console.log('Edit,index, row',index, row);
        },
        handleEnable(index, row){
            var data = [{
                'id':row['id'],
                'status':1,
            }];
            row[this.statusProp] = 1;
            this.compileTableColumnType();
            this.handleHttp(data);
        },
        handleDisable(index, row){
            var data = [{
                'id':row['id'],
                'status':0,
            }];
            row[this.statusProp] = 0;  
            this.compileTableColumnType();
            this.handleHttp(data);
        },
        handleDelete(index, row){
            console.log('delete,index, row',index, row);
        },
        handleHttp(data){
            this.$http.patch(this.tableDatas.url, data).then(function (Response) {
                if (Response.data.duration==null) {
                    Response.data.duration = 4500;
                }
                this.$notify({
                  title: Response.data.title,
                  message: Response.data.message,
                  type: Response.data.type,
                  iconClass: Response.data.iconClass,
                  customClass: Response.data.customClass,
                  duration: Response.data.duration,
                  onClose: Response.data.onClose,
                  offset: Response.data.offset,
                });
            });
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
