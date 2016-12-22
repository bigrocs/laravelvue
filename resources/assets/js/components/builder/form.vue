<template>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">
                <div class="form-group" v-for="data in fromDatas.datas">
                    <div v-if="data.type == 'text'" class="row">
                        <builder-text :datas="data"></builder-text>
                    </div>
                    <div v-if="data.type == 'textarea'" class="row">
                        <builder-textarea :datas="data"></builder-textarea>
                    </div>
                    <div v-if="data.type == 'switch'" class="row">
                        <builder-switch :datas="data"></builder-switch>
                    </div>
                    <div v-if="data.type == 'upload'" class="row">
                        <builder-upload :datas="data"></builder-upload>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import builderText from './packages/text.vue'
import builderTextarea from './packages/textarea.vue'
import builderSwitch from './packages/switch.vue'
import builderUpload from './packages/upload.vue'
export default {
    components: {
        builderText,
        builderTextarea,
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
