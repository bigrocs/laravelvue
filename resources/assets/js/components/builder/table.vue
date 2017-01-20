<template>
<div class="">
    <div slot="header" class="table-header">
        <el-button v-for="topButton in topButtonList" :type="topButton.class" @click="handleClick(topButton.method)">
            <i :class="topButton.icon"></i>
            {{topButton.title}}
        </el-button>
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
                        <el-button v-for="rightButton in scope.row[column.prop]" :type="rightButton.class" size="mini"  @click="handleClick(rightButton.method,scope.$index, scope.row)">
                            <i :class="rightButton.icon"></i>
                            {{rightButton.title}}
                        </el-button>
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
          :page-sizes="tableDatas.pagination.pageSizes"
          :page-size="tableDatas.pagination.pageSize"
          :layout="tableDatas.pagination.layout"
          :total="tableDatas.pagination.total">
        </el-pagination>
    </div>
    <el-dialog size="large" :title="dialogForm.form.title" v-model="$store.state.dialogFormVisible">
        <builder-form :fromDatas="dialogForm.form"></builder-form>
    </el-dialog>
</div>
</template>

<script>
import builderForm from './form.vue'
export default {
    components: {
        builderForm
    },
    created() {
        this.compileTopButton()             //编译顶部按钮
        this.compileRightButton()           //编译右侧按钮
        this.compileTableColumnType()       //编译整个页面属性
    },
    data() {
      return {
          topButtonList:[],
          rightButtonList:[],
          statusProp:null,
          dialogForm:{
              form:{
                  title:''
              }
          },
          multipleSelection: [],
          button:{
              'add':{
                  'title':'新增',
                  'icon':'fa fa-plus',
                  'class':'primary',
                  'method':'add'
              },
              'edit':{
                  'title':'编辑',
                  'icon':'fa fa-edit',
                  'class':'info',
                  'method':'edit'
              },
              'resume':{
                  'title':'启用',
                  'icon':'fa fa-check',
                  'class':'success',
                  'method':'resume'
              },
              'forbid':{
                  'title':'禁用',
                  'icon':'fa fa-ban',
                  'class':'warning',
                  'method':'forbid'
              },
              'display':{
                  'title':'显示',
                  'icon':'fa fa-check',
                  'class':'success',
                  'method':'display'
              },
              'hide':{
                  'title':'隐藏',
                  'icon':'fa fa-eye-slash',
                  'class':'warning',
                  'method':'hide'
              },
              'delete':{
                  'title':'删除',
                  'icon':'fa fa-trash',
                  'class':'danger',
                  'method':'delete'
              },
          }
      }
    },
    watch: {
        tableDatas: 'compileTableColumnType'
    },
    methods: {
        /**
         * [compileTopButton 编译表格右侧按钮]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2017-01-6 T17:00:30+0800
         * @return   [type]                   [description]
         */
        compileTopButton(){
            this.topButtonList = [];
            for (var key in this.tableDatas.topButton) {
                switch (this.tableDatas.topButton[key].type) {
                    case 'addnew':  // 新增按钮
                        var button = this.button.add;
                        this.topButtonList.push(button);
                        break;
                    case 'resume':  // 启用按钮
                        var button = this.button.resume;
                        this.topButtonList.push(button);
                        break;
                    case 'forbid':  // 禁用按钮
                        var button = this.button.forbid;
                        this.topButtonList.push(button);
                        break;
                    case 'delete':  // 禁用按钮
                        var button = this.button.delete;
                        this.topButtonList.push(button);
                        break;
                }
            }
        },
        /**
         * [compileRightButton 编译表格右侧按钮]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2017-01-6T17:00:30+0800
         * @return   [type]                   [description]
         */
        compileRightButton(){
            this.rightButtonList = [];
            for (var key in this.tableDatas.rightButton) {
                switch (this.tableDatas.rightButton[key].type) {
                    case 'edit':  // 编辑按钮
                        var button = this.button.edit;
                        this.rightButtonList.push(button);
                        break;
                    case 'forbid':  //改变记录状态按钮，会更具数据当前的状态自动选择应该显示启用/禁用
                        var button ={
                            0:this.button.resume,
                            1:this.button.forbid,
                            'type':'forbid',
                        };
                        this.rightButtonList.push(button);
                        break;
                    case 'hide':  //改变记录状态按钮，会更具数据当前的状态自动选择应该显示启用/禁用
                            var button ={
                                2:this.button.display,
                                1:this.button.hide,
                                'type':'hide',
                            };
                            this.rightButtonList.push(button);
                            break;
                    case 'delete':  // 删除按钮
                        var button = this.button.delete;
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
                            switch(this.tableDatas.datas[w][this.statusProp]){
                                case -1:
                                    this.tableDatas.datas[w][this.statusProp] = {
                                        'value':-1,
                                        'type':'danger',
                                        'icon':'fa fa-trash',
                                        'title':'删除',
                                    };
                                    break;
                                case 0:
                                    this.tableDatas.datas[w][this.statusProp] = {
                                        'value':0,
                                        'type':'warning',
                                        'icon':'fa fa-ban',
                                        'title':'禁用',
                                    };
                                    break;
                                case 1:
                                    this.tableDatas.datas[w][this.statusProp] = {
                                        'value':1,
                                        'type':'success',
                                        'icon':'fa fa-check',
                                        'title':'正常',
                                    };
                                    break;
                                case 2:
                                    this.tableDatas.datas[w][this.statusProp] = {
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
                case 'add':
                    this.handleAdd(index, row)
                    break;
                case 'edit':
                    this.handleEdit(index, row)
                    break;
                case 'resume':
                    this.handleResume(index, row)
                    break;
                case 'forbid':
                    this.handleForbid(index, row)
                    break;
                case 'display':
                    this.handleDisplay(index, row)
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
        handleAdd(index, row) {
            this.dialogFormHttp(this.tableDatas.apiUrl.urlAdd)
        },
        handleEdit(index, row) {
            this.dialogFormHttp(this.tableDatas.apiUrl.urlEdit,{'id':row.id})
        },
        handleResume(index, row){
            var data = this.changeDatastate(row,1);//批量数据更改状态
            this.handleHttp(this.tableDatas.apiUrl.urlStatus,data);
        },
        handleForbid(index, row){
            var data = this.changeDatastate(row,0);//批量数据更改状态
            this.handleHttp(this.tableDatas.apiUrl.urlStatus,data);
        },
        handleDisplay(index, row){
            var data = this.changeDatastate(row,1);//批量数据更改状态
            this.handleHttp(this.tableDatas.apiUrl.urlStatus,data);
        },
        handleHide(index, row){
            var data = this.changeDatastate(row,2);//批量数据更改状态
            this.handleHttp(this.tableDatas.apiUrl.urlStatus,data);
        },
        handleDelete(index, row){
            var data = [];
            if (row==null) {
                for (var key in this.multipleSelection) {
                    data[key] = {
                        'id':this.multipleSelection[key].id,
                    }
                }
            }else{
                data = [{
                    'id':row.id
                }];
            }
            this.$confirm('此操作将永久删除此数据, 是否继续?', '危险提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'error'
            }).then(() => {
                if (index == null) {
                    //批量删除页面显示数据
                    for (var key in this.multipleSelection) {
                        for (var dataKey in this.tableDatas.datas) {
                            if (this.multipleSelection[key].id == this.tableDatas.datas[dataKey].id) {
                                this.tableDatas.datas.splice(dataKey, 1);
                            }
                        }
                    }
                }else{
                    this.tableDatas.datas.splice(index, 1);
                }
                this.handleHttp(this.tableDatas.apiUrl.urlDelete,data);//通知服务端删除数据
            }).catch(() => {
                this.$notify({
                    title: '操作取消',
                    message: '已取消删除',
                    type: 'info',
                });
            });
        },
        dialogFormHttp(url,data){
            this.$store.state.dialogFormVisible = true
            this.$http.post(url,data).then(function (Response) {
                this.$set(this.dialogForm, 'form', Response.data.form) //获取页面数据赋值
            }, (response) => {
                this.$notify({
                  title: '操作失败',
                  message: '操作失败请联系管理员！',
                  type: 'error',
                });
            });
        },
        handleHttp(url,data){
            this.$http.post(url, data).then(function (Response) {
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
            this.multipleSelection = val;
        },
        /**
         * 批量更改数据状态
         */
        changeDatastate(row,state){
            // 整理返回数据
            var data = [];
            if (row==null) {
                for (var key in this.multipleSelection) {
                    data[key] = {
                        'id':this.multipleSelection[key].id,
                        'status':state,
                    }
                }
                //改变页面显示数据
                for (var key in this.multipleSelection) {
                    for (var dataKey in this.tableDatas.datas) {
                        if (this.multipleSelection[key].id == this.tableDatas.datas[dataKey].id) {
                            this.tableDatas.datas[dataKey][this.statusProp] = state;
                        }
                    }
                }
            }else{
                data = [{
                    'id':row.id,
                    'status':state,
                }];
                row[this.statusProp] = state;
            }

            this.compileTableColumnType();//改变数据后重新编译显示页面
            return data;
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
    .el-button{
        margin-top:10px !important;
        margin-left:0px !important;
        margin-right:10px !important;
    }
    .table-header{
        padding-bottom:15px;
    }
    .table-bottom{
        padding-top:15px;
    }
</style>
