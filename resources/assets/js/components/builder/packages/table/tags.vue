<template>
    <div>
        <el-tag
            :style="tagStyle"
            v-for="(tag,key) in datas"
            :key="key"
            :type="config.type"
        >
          <template v-if="config.keyNmae">{{tag[config.keyNmae]}}</template>
          <template v-else>{{tag}}</template>            
        </el-tag>
    </div>
</template>
<script>
export default {
    props: {
        datas: {
            type: Array,
            default: ''
        },
        column: {
            type: Object,
            default: ''
        },
    },
    data() {
        return {
            tagStyle:{
                marginTop:'5px' ,
                marginLeft:'10px' ,
                marginBottom:'5px' ,
            },
            config:{
                type:'',
                valueName:''
            }
        };
    },
    created() {
        this.compileColumn()
    },
    methods: {
        compileColumn() {
            if(this.column.config){
                this.config = this.column.config;
            }
        },

    },
  }
</script>
