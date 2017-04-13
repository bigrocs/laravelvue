<template>
    <el-form-item :label="config.label" :prop="config.name">
        <el-input-number
            :min="config.min"
            :max="config.max"
            :step="config.step"
            :size="config.size"
            :disabled="config.disabled"
            :controls="config.controls"
            v-model="value"
            @change="handleChange"
        >
        </el-input-number>
    </el-form-item>
</template>
<script>
export default{
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
            value:0
        };
    },
    created() {
        this.Initialization();
    },
    watch: {
        datas:'Initialization'
    },
    methods:{
        Initialization(){
            let name = this.config.name
            if (this.datas[name]) {
                this.value = this.datas[name]
            }
            if (!this.config.min) {
                this.config.min = 0;
            }
            if (!this.config.max) {
                this.config.max = Infinity;
            }
            if (!this.config.step) {
                this.config.step = 1;
            }
            if (!this.datas.disabled) {
                this.datas.disabled = false;
            }
            if (!this.config.controls) {
                this.config.controls = true;
            }
        },
        handleChange(value){
            let name = this.config.name
            this.datas[name] = value
        }
    }
}
</script>
