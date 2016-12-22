<template>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">
                <div class="form-group" v-for="data in fromDatas.datas">
                    <div v-if="data.buliderType == 'input'" class="row">
                        <builder-input :datas="data"></builder-input>
                    </div>
                    <div v-if="data.buliderType == 'switch'" class="row">
                        <builder-switch :datas="data"></builder-switch>
                    </div>
                    <div v-if="data.buliderType == 'upload'" class="row">
                        <builder-upload :datas="data"></builder-upload>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import builderInput from './packages/input.vue'
import builderSwitch from './packages/switch.vue'
import builderUpload from './packages/upload.vue'
export default {
    components: {
        builderInput,
        builderSwitch,
        builderUpload
    },
    created() {
        this.fromDatas = this.datas;
    },
    data() {
        return {
            fromDatas: {}
        };
    },
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
}
</script>
