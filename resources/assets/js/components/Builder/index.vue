<template>
<div class="">
    <!-- <div class="form-group" v-for="data in datas">
        <div v-if="formData.buliderType == 'input'" class="row">
            <builder-input :datas="data"></builder-input>
        </div>
        <div v-if="formData.buliderType == 'switch'" class="row">
            <builder-switch :datas="data"></builder-switch>
        </div>
        <div v-if="formData.buliderType == 'upload'" class="row">
            <builder-upload :datas="data"></builder-upload>
        </div>
    </div> -->
    <builder-form :datas="datas"></builder-form>
    
</div>
</template>
<script>
import builderForm from './layouts/form.vue'
export default {
    components: {
        builderForm,
    },
    created() {
        this.getData()
    },
    data() {
        return {
            datas:{}
        };
    },
    watch: {
       $route: 'getData'
    },
    methods:{
        /**
         * 获取页面数据
         */
        getData(){
            this.$store.commit('getCurrentApiUrl',this.$route.name)                 //当去当前路由API地址 赋值this.$store.state.CurrentUrl
            this.$http.get(this.$store.state.CurrentApiUrl).then((Response) => {
                this.$set(this,'datas', Response.data)                              //获取页面数据赋值
            })
        }
    }

};
</script>
<style>
.check-tips {
    color: #95A5A6;
}
</style>
