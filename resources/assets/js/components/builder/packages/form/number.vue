<template>
<div class="row">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-input-number
            :min="datas.min"
            :max="datas.max"
            :step="datas.step"
            :size="datas.size"
            :disabled="datas.disabled"
            :controls="datas.controls"
            v-model="value"
            @change="handleChange"
        >
        </el-input-number>
    </div>
    <div class="col-md-6 col-sm-12">
        <span class="check-tip small">{{ datas.placeholder }}</span>
    </div>
</div>
</template>
<script>
export default{
    props: {
        datas: {
            type: Object,
            default: {
                value:0
            }
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
            if (this.datas.value) {
                this.value = this.datas.value
            }
            if (!this.datas.min) {
                this.datas.min = 0;
            }
            if (!this.datas.max) {
                this.datas.max = Infinity;
            }
            if (!this.datas.step) {
                this.datas.step = 1;
            }
            if (!this.datas.disabled) {
                this.datas.disabled = false;
            }
            if (!this.datas.controls) {
                this.datas.controls = true;
            }
        },
        handleChange(value){
            this.datas.value = value
        }
    }
}
</script>
