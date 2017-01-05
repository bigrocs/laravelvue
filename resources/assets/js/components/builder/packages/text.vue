<template>
<div class="row">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-input
            type="text"
            :placeholder="datas.placeholder"
            :maxlength="datas.maxlength"
            :minlength="datas.minlength"
            :disabled="datas.disabled"
            :size="datas.size"
            :icon="datas.icon"
            :rows="datas.rows"
            :autosize="datas.autosize"
            :name="datas.name"
            :max="datas.max"
            :min="datas.min"
            :autofocus="datas.autofocus"
            :form="datas.form"
            v-model="datas.value">
        </el-input>
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
}
</script>
