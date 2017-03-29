<template>
    <div>
        <el-tag
            :style="tagStyle"
            v-for="(tag,key) in datas"
            :key="key"
            :type="config.type"
        >
          <template v-if="config.valueName">{{tag[config.valueName]}}</template>
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
        config: {
            type: Object,
            default: {
                valueName:'',
                type:'',
            }
        },
    },
    data() {
        return {
            tagStyle:{
                marginTop:'5px' ,
                marginLeft:'10px' ,
                marginBottom:'5px' ,
            }
        };
    },
  }
</script>
