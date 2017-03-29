<template>
    <el-button :type="buttons.type" :style="buttonStyle" @click="handleClick(buttons.method)">
        <i :class="buttons.icon"></i>
        {{buttons.title}}
    </el-button>
</template>
<script>
export default {
    props: {
        datas: {
            type: Object,
            default: ''
        },
        apiUrl: {
            type: Object,
            default: ''
        },
        type: {
            type: String,
            default: ''
        },
    },
    data() {
        return {
            buttonStyle:{
            	marginBottom:'10px',
        		marginLeft:'0px',
        		marginRight:'10px',
            },
            buttons:{},
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
        };
    },
    created() {
        this.compileData()
    },
    watch: {
        datas: 'compileData',
    },
    methods: {
    	compileData(){
    		switch(this.type) {
    			case 'topButton':
    				this.compileTopButton()	
    				break;
    			case 'rightButton':
    				this.buttonStyle.marginBottom = '5px'
    				this.buttonStyle.marginRight = '5px'
    				break;
    		}
    	},
    	/**
         * [compileTopButton 编译表格顶部按钮]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2017-01-6 T17:00:30+0800
         * @return   [type]                   [description]
         */
        compileTopButton(){
            let buttonDatas = this.datas;
            let buttonProperty = this.button;
            switch(buttonDatas.type) {
            	case 'add':  // 新增按钮
            		this.buttons = Object.assign(buttonProperty.add,buttonDatas.property);
                    break;
                case 'resume':  // 启用按钮
                	this.buttons = Object.assign(buttonProperty.resume,buttonDatas.property);
                    break;
                case 'forbid':  // 禁用按钮
                	this.buttons = Object.assign(buttonProperty.forbid,buttonDatas.property);
                    break;
                case 'delete':  // 禁用按钮
                	this.buttons = Object.assign(buttonProperty.delete,buttonDatas.property);
                    break;
            }
        },
        /**
         * [handleClick table按钮点击事件控制分发器]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2017-01-03T10:02:07+0800
         * @param    [type]                     $method       [动作命令]
         * @param   [type]                      $index        [动作行序号]
         * @param   [type]                      $row          [动作数据]
         */
        handleClick(method,index, row) {
            switch (method) {
                case 'add':
                    this.dialogFormHttp(this.apiUrl.urlAdd)
                    break;
                case 'edit':
                    this.dialogFormHttp(this.apiUrl.urlEdit,{'id':row.id})
                    break;
                case 'resume':
                    var data = this.changeDatastate(row,1);//批量数据更改状态
                    this.handleHttp(this.apiUrl.urlStatus,data);
                    break;
                case 'forbid':
                    var data = this.changeDatastate(row,0);//批量数据更改状态
                    this.handleHttp(this.apiUrl.urlStatus,data);
                    break;
                case 'display':
                    var data = this.changeDatastate(row,1);//批量数据更改状态
                    this.handleHttp(this.apiUrl.urlStatus,data);
                    break;
                case 'hide':
                    let data = this.changeDatastate(row,2);//批量数据更改状态
                    this.handleHttp(this.apiUrl.urlStatus,data);
                    break;
                case 'delete':
                    this.handleDelete(index, row)
                    break;
                default:
            }
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
        dialogFormHttp(url,data){
            console.log(url);
            let _this = this;
            this.$store.dispatch('dialogFormVisibleTrue')//打开弹窗form
            // axios.post(url,data).then(function (Response) {
            //     _this.$set(_this.dialogForm, 'form', Response.data.form) //获取页面数据赋值
            // }, (response) => {
            //     this.$notify({
            //       title: '操作失败',
            //       message: '操作失败请联系管理员！',
            //       type: 'error',
            //     });
            // });
        },
    }
}
</script>