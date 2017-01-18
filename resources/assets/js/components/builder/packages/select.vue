<template>
<div class="row">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-select
            type="text"
            :placeholder="datas.placeholder"
            :multiple="datas.multiple"
            :disabled="datas.disabled"
            :size="datas.size"
            :clearable="datas.clearable"
            :multiple-limit="datas.multipleLimit"
            :name="datas.name"
            :filterable="datas.filterable"
            :allow-create="datas.allowCreate"
            :filter-method="datas.filterMethod"
            :remote="datas.remote"
            :remote-method="datas.remoteMethod"
            :loading="datas.loading"
            :loading-text="datas.loadingText"
            :no-match-text="datas.noMatchText"
            :no-data-text="datas.noDataText"
            :popper-class="datas.popperClass"
            v-model="datas.value">
            <el-option
              v-for="(item,key) in datas.options"
              :label="item"
              :value="key">
            </el-option>
        </el-select>
    </div>
    <div class="col-md-6 col-sm-12">
        <span class="check-tip small">{{ datas.placeholder }}</span>
    </div>
</div>
</template>
<script>
export default{
    created() {
        if (this.datas.value==null) {this.datas.value = ''}
    },
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
}
</script>
