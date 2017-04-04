<template>
    <div>
        <template v-if="config.keyNmae">{{datas[config.keyNmae]}}</template>
        <template v-else>{{datas}}</template>    
    </div>
</template>
<script>
export default {
    props: {
        datas: {
            type: '',
            default: ''
        },
        column: {
            type: Object,
            default: ''
        },
    },
    data() {
        return {
            config:''
        };
    },
    created() {
        this.compileColumn()
    },
    watch: {
        datas: 'compileColumn',
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
