<template>
<div class="">
    <div slot="header" class="table-header">
        <div class="row">
            <div class="col-md-8">
<!--                 <el-button v-for="topButton in topButtonList" class="table-button" :type="topButton.type" @click="handleClick(topButton.method)">
                    <i :class="topButton.icon"></i>
                    {{topButton.title}}
                </el-button> -->
                <table-button v-for="(topButton,key) in tableDatas.topButton" :key="key" :datas="topButton" :apiUrl="tableDatas.apiUrl" type="topButton"></table-button>
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
                        <el-button v-for="(rightButton,key) in scope.row[column.prop]" :key="key" class="table-button-min" :type="rightButton.type" size="mini"  @click="handleClick(rightButton.method,scope.$index, scope.row)">
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
        this.compileRightButton()           //编译右侧按钮
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
         * [compileTopButton 编译表格右侧按钮]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2017-01-6 T17:00:30+0800
         * @return   [type]                   [description]
         */
        // compileTopButton(){
        //     let topButtonList = [];
        //     let topButton = this.tableDatas.topButton;
        //     let buttonProperty = this.button;
        //     for (var key in topButton) {
        //         let topButtonType = topButton[key].type;
        //         let topButtonProperty = topButton[key].property;
        //         switch (topButtonType) {
        //             case 'add':  // 新增按钮
        //                 var button = Object.assign(buttonProperty.add,topButtonProperty);
        //                 topButtonList.push(button);
        //                 break;
        //             case 'resume':  // 启用按钮
        //                 var button = Object.assign(buttonProperty.resume,topButtonProperty);
        //                 topButtonList.push(button);
        //                 break;
        //             case 'forbid':  // 禁用按钮
        //                 var button = Object.assign(buttonProperty.forbid,topButtonProperty);
        //                 topButtonList.push(button);
        //                 break;
        //             case 'delete':  // 禁用按钮
        //                 var button = Object.assign(buttonProperty.delete,topButtonProperty);;
        //                 topButtonList.push(button);
        //                 break;
        //         }
        //     }
        //     this.topButtonList = topButtonList;
        // },
        /**
         * [compileRightButton 编译表格右侧按钮]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2017-01-6T17:00:30+0800
         * @return   [type]                   [description]
         */
        compileRightButton(){
            let rightButtonList = [];
            for (var key in this.tableDatas.rightButton) {
                switch (this.tableDatas.rightButton[key].type) {
                    case 'edit':  // 编辑按钮
                        var button = this.button.edit;
                        rightButtonList.push(button);
                        break;
                    case 'forbid':  //改变记录状态按钮，会更具数据当前的状态自动选择应该显示启用/禁用
                        var button ={
                            0:this.button.resume,
                            1:this.button.forbid,
                            'type':'forbid',
                        };
                        rightButtonList.push(button);
                        break;
                    case 'hide':  //改变记录状态按钮，会更具数据当前的状态自动选择应该显示启用/禁用
                            var button ={
                                2:this.button.display,
                                1:this.button.hide,
                                'type':'hide',
                            };
                            rightButtonList.push(button);
                            break;
                    case 'delete':  // 删除按钮
                        var button = this.button.delete;
                        rightButtonList.push(button);
                        break;
                    default:
                        break;
                }
            }
            this.rightButtonList = rightButtonList;
        },
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
                        case 'btn':
                            let rightButtonData = [];
                            let rightButtonList = this.rightButtonList;
                            let datas = this.tableDatas.datas;
                            let statusProp = this.statusProp;
                            let column = this.tableDatas.column;
                            for (var key in rightButtonList) {
                                if(rightButtonList[key].type == 'forbid' || rightButtonList[key].type == 'hide'){
                                    var statusValue = datas[w][statusProp];
                                    if (rightButtonList[key][statusValue]) {
                                        rightButtonData.push(rightButtonList[key][statusValue]);
                                    }
                                }else{
                                    rightButtonData.push(rightButtonList[key]);
                                }
                            }
                            this.tableDatas.datas[w][column[i].prop] = rightButtonData;
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
            let data = this.changeDatastate(row,2);//批量数据更改状态
            this.handleHttp(this.tableDatas.apiUrl.urlStatus,data);
        },
        handleDelete(index, row){
            let data = [];
            if (row==null) {
                for (let key in this.multipleSelection) {
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
        // dialogFormHttp(url,data){
        //     let _this = this;
        //     this.$store.state.dialogFormVisible = true
        //     axios.post(url,data).then(function (Response) {
        //         _this.$set(_this.dialogForm, 'form', Response.data.form) //获取页面数据赋值
        //     }, (response) => {
        //         this.$notify({
        //           title: '操作失败',
        //           message: '操作失败请联系管理员！',
        //           type: 'error',
        //         });
        //     });
        // },
        handleHttp(url,data){
            let _this = this;
            axios.post(url, data)
              .then(function (Response) {
                if (Response.data.duration==null) {
                    Response.data.duration = 4500;
                }
                _this.$notify({
                  title: Response.data.title,
                  message: Response.data.message,
                  type: Response.data.type,
                  iconClass: Response.data.iconClass,
                  customClass: Response.data.customClass,
                  duration: Response.data.duration,
                  onClose: Response.data.onClose,
                  offset: Response.data.offset,
                });
            })
            .catch(function (error) {
                _this.$notify({
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
         * [changeDatastate 批量更改数据状态]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:48:46+0800
         * @param    {[type]}                 row   [description]
         * @param    {[type]}                 state [description]
         * @return   {[type]}                       [description]
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
    .table-button{
        margin-bottom:10px !important;
        margin-left:0px !important;
        margin-right:10px !important;
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
