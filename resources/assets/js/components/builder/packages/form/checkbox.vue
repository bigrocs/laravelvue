<template>
    <el-form-item :label="config.label" :prop="config.name">
    	<el-checkbox-group v-model="checkList">
    		<el-checkbox v-for="(option,key) in config.options" :label="option.id" :key="key">{{ option.name }}</el-checkbox>
	  	</el-checkbox-group>
    </el-form-item>
</template>
<script>
export default {
  	props: {
        datas: {
            type: '',
            default: ''
        },
        config: {
            type: Object,
            default: ''
        },
    },
    data() {
      return {
        checkList: []
      };
    },
    created() {
        this.Initialization();
    },
    watch: {
        datas:'Initialization',
        checkList:'watchCheckList'
    },
    methods:{
        Initialization(){
            let name = this.config.name
            this.checkList = this.datas[name]
        },
        watchCheckList(){
        	let name = this.config.name
        	this.datas[name] = this.checkList
        }
    }
};
</script>