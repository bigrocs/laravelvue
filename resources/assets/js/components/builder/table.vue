<template>
    <div class="col-md-12">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <el-button type="primary"><i class="fa fa-plus"></i> 操作按钮</el-button>
                <el-button type="success"><i class="fa fa-plus"></i> 操作按钮</el-button>
                <el-button type="warning"><i class="fa fa-plus"></i> 操作按钮</el-button>
                <el-button type="danger"><i class="fa fa-plus"></i> 操作按钮</el-button>
                <el-button style="float: right;" type="primary">操作按钮</el-button>
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
                    case 'hide':  //改变记录状态按钮，会更具数据当前的状态自动选择应该显示启用/禁用
                            var button ={
                                2:{
                                    'title':'显示',
                                    'icon':'fa fa-check',
                                    'class':'success',
                                    'method':'enable'
                                },
                                1:{
                                    'title':'隐藏',
                                    'icon':'fa fa-eye-slash',
                                    'class':'warning',
                                    'method':'hide'
                                },
                                'type':'hide',
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
                                if(this.rightButtonList[key].type == 'forbid' || this.rightButtonList[key].type == 'hide'){
                                    var statusValue = this.tableDatas.datas[w][this.statusProp].value;
                                    if (this.rightButtonList[key][statusValue]) {
                                        rightButtonData.push(this.rightButtonList[key][statusValue]);
                                    }
                                }else{
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
        /**
         * [handleClick 左右table按钮中控制分发器]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2017-01-03T10:02:07+0800
         * @param    [type]                     $method       [动作命令]
         * @param   [type]                      $index        [动作行序号]
         * @param   [type]                      $row          [动作数据]
         */
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
                case 'hide':
                    this.handleHide(index, row)
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
            this.handleHttp(this.tableDatas.urlStatus,data);
        },
        handleDisable(index, row){
            var data = [{
                'id':row['id'],
                'status':0,
            }];
            row[this.statusProp] = 0;
            this.compileTableColumnType();
            this.handleHttp(this.tableDatas.urlStatus,data);
        },
        handleHide(index, row){
            var data = [{
                'id':row['id'],
                'status':2,
            }];
            row[this.statusProp] = 2;
            this.compileTableColumnType();
            this.handleHttp(this.tableDatas.urlStatus,data);
        },
        handleDelete(index, row){
            var data = [{
                'id':row['id']
            }];
            this.$confirm('此操作将永久删除此数据, 是否继续?', '危险提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'error'
            }).then(() => {
                this.tableDatas.datas.splice(index, 1);
                this.handleHttp(this.tableDatas.urlDelete,data);
            }).catch(() => {
                this.$notify({
                    title: '操作取消',
                    message: '已取消删除',
                    type: 'info',
                });
            });
        },
        handleHttp(url,data){
            this.$http.patch(url, data).then(function (Response) {
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
            }, (response) => {
                this.$notify({
                  title: '操作失败',
                  message: '操作失败请联系管理员！',
                  type: 'error',
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
<style lang="css">
    .el-button{
        margin-top:10px !important;
        margin-left:10px !important;
    }
</style>
