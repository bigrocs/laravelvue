<template>
<div class="">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <input
            :type="datas.type"
            :placeholder="datas.placeholder"
            :maxlength="datas.maxlength"
            :minlength="datas.minlength"
            :disabled="datas.disabled"
            :size="datas.size"
            :icon="datas.icon"
            :number="datas.number"
            :rows="datas.rows"
            :autosize="datas.autosize"
            :number="true"
            v-model="datas.value">
        </input>
    </div>
    <div class="col-md-6 col-sm-12">
        <span class="check-tips small">{{ datas.tips }}</span>
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
