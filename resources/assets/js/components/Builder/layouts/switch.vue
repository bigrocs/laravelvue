<template>
<div class="">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-switch
          v-model="datas.value"
          on-color="#13ce66"
          off-color="#ff4949">
        </el-switch>
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
