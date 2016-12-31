<template>
    <div>
        <div v-if="datas.type == 'text'" class="row">
            <builder-text :datas="datas"></builder-text>
        </div>
        <div v-if="datas.type == 'textarea'" class="row">
            <builder-textarea :datas="datas"></builder-textarea>
        </div>
        <div v-if="datas.type == 'number'" class="row">
            <builder-number :datas="datas"></builder-number>
        </div>
        <div v-if="datas.type == 'switch'" class="row">
            <builder-switch :datas="datas"></builder-switch>
        </div>
        <div v-if="datas.type == 'picture'" class="row">
            <builder-picture :datas="datas"></builder-picture>
        </div>
        <div v-if="datas.type == 'upload'" class="row">
            <builder-upload :datas="datasdatas"></builder-upload>
        </div>
    </div>
</template>
<script>
import builderText from './text.vue'
import builderTextarea from './textarea.vue'
import builderNumber from './number.vue'
import builderSwitch from './switch.vue'
import builderPicture from './picture.vue'
import builderUpload from './upload.vue'
export default {
    components: {
        builderText,
        builderTextarea,
        builderNumber,
        builderSwitch,
        builderPicture,
        builderUpload
    },
    // data() {
    //     return {
    //         data: this.datas,
    //     };
    // },
    created() {
            // console.log(this.datas);
    },
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
}
</script>
