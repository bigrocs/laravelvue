<template>
    <el-button :type="buttons.type" :style="buttonStyle">
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
    }
}
</script>