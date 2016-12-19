<template>
<div class="">
    123
    <div class="form-group" v-for="data in datas">
        <div v-if="formData.buliderType == 'input'" class="row">
            <builder-input :datas="data"></builder-input>
        </div>
        <div v-if="formData.buliderType == 'switch'" class="row">
            <builder-switch :datas="data"></builder-switch>
        </div>
        <div v-if="formData.buliderType == 'upload'" class="row">
            <builder-upload :datas="data"></builder-upload>
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
    created() {
        this.getData()
    },
    data() {
        return {
            datas: ''
        };
    },
    watch: {
       $route: 'getData'
    },
    methods:{
        getData(){
            this.$store.commit('getCurrentApiUrl',this.$route.name)//当去当前路由API地址 赋值this.$store.state.CurrentUrl

            console.log(this.$store.state.CurrentApiUrl);
        }
    }

};
</script>
<style>
.check-tips {
    color: #95A5A6;
}
</style>
