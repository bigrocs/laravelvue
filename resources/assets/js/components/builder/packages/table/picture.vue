<template>
    <div>
        <template>
            <img 
                :src="src" 
                :class="config.class" 
                :alt="config.alt" 
                :width="config.width" 
                :height="config.height"
                @click="pictureDialogVisible = true"
            >
        </template>
        <el-dialog v-model="pictureDialogVisible">
            <img 
                :src="src" 
                :class="config.class" 
                :alt="config.alt" 
            >
        </el-dialog>    
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
            src:'',
            config:'',
            pictureDialogVisible:false,
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
            if (this.config.keyNmae) {
                this.src = this.datas[this.config.keyNmae]
            }else{
                this.src = this.datas
            }
        },

    },
  }
</script>
