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
            v-model="datas.value">
        </el-input-number>
    </div>
    <div class="col-md-6 col-sm-12">
        <span class="check-tip small">{{ datas.tip }}</span>
    </div>
</div>
</template>
<script>
export default{
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
    created() {
        if (this.datas.min==null) {
            this.min = 0;
        }
        if (this.datas.max==null) {
            this.max = 'Infinity';
        }
        if (this.datas.step==null) {
            this.step = 1;
        }
        if (this.datas.disabled==null) {
            this.disabled = false;
        }
        if (this.datas.controls==null) {
            this.controls = true;
        }
    }
}
</script>
