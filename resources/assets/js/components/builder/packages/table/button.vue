<template>
    <el-button :type="buttons.type" :style="buttonStyle" :size="size" @click="handleClick(buttons.method)">
        <i :class="buttons.icon"></i>
        {{buttons.title}}
    </el-button>
</template>
<script>
export default {
    props: {
        buttonDatas: {
            type: Object,
            default: ''
        },
        id: {
            type: '',
            default: ''
        },
        status: {
            type: String,
            default: ''
        },
        apiUrl: {
            type: Object,
            default: ''
        },
        multipleSelection:{
            type: Array,
            default: ''
        },
        size:{
            type: String,
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
            buttonProperty:{
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
        status: 'compileData',
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
            this.compileRightButton()
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
            let buttonDatas = this.buttonDatas;
            let buttonProperty = this.buttonProperty;
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
                case 'delete':  // 删除按钮
                	this.buttons = Object.assign(buttonProperty.delete,buttonDatas.property);
                    break;
            }
        },
        /**
         * [compileRightButton 编译表格右侧按钮]
         * @Author   BigRocs                  BigRocs@qq.com
         * @DateTime 2017-01-6T17:00:30+0800
         * @return   [type]                   [description]
         */
        compileRightButton(){
          let buttonDatas = this.buttonDatas;
          let buttonProperty = this.buttonProperty;
          switch(buttonDatas.type) {
              case 'edit':  // 编辑按钮
                  this.buttons = Object.assign(buttonProperty.edit,buttonDatas.property);
                  break;
              case 'forbid':  //改变记录状态按钮，会更具数据当前的状态自动选择应该显示启用/禁用
                  if(this.status=='1'){
                      this.buttons = Object.assign(buttonProperty.forbid,buttonDatas.property);
                  }else if(this.status=='0'){
                      this.buttons = Object.assign(buttonProperty.resume,buttonDatas.property);
                  }
                  break;
              case 'hide':  //改变记录状态按钮，会更具数据当前的状态自动选择应该显示 显示/因此
                  if(this.status=='1'){
                      this.buttons = Object.assign(buttonProperty.hide,buttonDatas.property);
                  }else if(this.status=='2'){
                      this.buttons = Object.assign(buttonProperty.display,buttonDatas.property);
                  }
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
         */
        handleClick(method,index) {
            let thenFunction = (Response) => {
                this.$store.dispatch('getCurrentData')//重新加载页面POST数据
            }
            switch (method) {
                case 'add':
                    this.$store.dispatch('openDialogForm',{url:this.apiUrl.urlAdd})     //获取页面数据
                    break;
                case 'edit':
                    var postData = {'id':this.id};        //发送数据ID
                    this.$store.dispatch('openDialogForm',{url:this.apiUrl.urlEdit,postData})     //获取页面数据
                    break;
                case 'resume':
                    var postData = this.changeDataState(this.id,1);//批量数据更改状态
                    this.$store.dispatch('getHttpNotify',{url:this.apiUrl.urlStatus,postData,thenFunction})     //获取页面数据
                    break;
                case 'forbid':
                    var postData = this.changeDataState(this.id,0);//批量数据更改状态
                    this.$store.dispatch('getHttpNotify',{url:this.apiUrl.urlStatus,postData,thenFunction})     //获取页面数据
                    break;
                case 'display':
                    var postData = this.changeDataState(this.id,1);//批量数据更改状态
                    this.$store.dispatch('getHttpNotify',{url:this.apiUrl.urlStatus,postData,thenFunction})     //获取页面数据
                    break;
                case 'hide':
                    var postData = this.changeDataState(this.id,2);//批量数据更改状态
                    this.$store.dispatch('getHttpNotify',{url:this.apiUrl.urlStatus,postData,thenFunction})     //获取页面数据
                    break;
                case 'delete':
                    var postData = this.changeDataState(this.id,-1);//批量数据更改状态
                    this.$confirm('此操作将永久删除此数据, 是否继续?', '危险提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'error'
                    }).then(() => {
                        this.$store.dispatch('getHttpNotify',{url:this.apiUrl.urlDelete,postData,thenFunction})     //获取页面数据
                    }).catch(() => {
                        this.$notify({
                            title: '操作取消',
                            message: '已取消删除',
                            type: 'info',
                        });
                    });
                    break;
                default:
            }
        },
        /**
         * [changeDataState 批量更改数据状态]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:48:46+0800
         * @param    {[type]}                 state [description]
         * @return   {[type]}                       [description]
         */
        changeDataState(id,state){
            // 整理返回数据
            let data = [];
            if (id) {
                data = [{
                    'id':id,
                    'status':state,
                }];
            }else{
                for (var key in this.multipleSelection) {
                    data[key] = {
                        'id':this.multipleSelection[key].id,
                        'status':state,
                    }
                }
            }

            return data;
        },
    }
}
</script>
