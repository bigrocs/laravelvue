<template>
<div class="">
    <div class="form-group" v-for="formData in formDatas">
        <div v-if="formData.name == 'input'" class="row">
            <builder-input :datas="formData"></builder-input>
        </div>
        <div v-if="formData.name == 'switch'" class="row">
            <builder-switch :datas="formData"></builder-switch>
        </div>
        <div v-if="formData.name == 'upload'" class="row">
            <builder-upload :datas="formData"></builder-upload>
        </div>
    </div>
</div>
</template>
<script>
import builderInput from './layouts/input.vue'
import builderSwitch from './layouts/switch.vue'
import builderUpload from './layouts/upload.vue'
export default {
    components: {
        builderInput,
        builderSwitch,
        builderUpload
    },
    props: {
        builderDatas: {
            type: Object,
            default: ''
        },
    },
    data() {
        return {
            formDatas: this.formDatas
        };
    },
    // 加载
    mounted() {
        this.formDatas = this.builderDatas.formDatas
    }
};
</script>
<style>
.check-tips {
    color: #95A5A6;
}
</style>
