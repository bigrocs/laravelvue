<template>
<div class="row">
    <template v-for="data in datas">
        <template v-if="data.type == 'form'">
            <builder-form :datas="data"></builder-form>
        </template>
    </template>
</div>
</template>
<script>
import builderForm from './form.vue'
export default {
    components: {
        builderForm,
    },
    created() {
        this.getData()
    },
    data() {
        return {
            datas: {}
        };
    },
    watch: {
        $route: 'getData'
    },
    methods: {
        /**
         * 获取页面数据
         */
        getData() {
            this.$store.commit('getCurrentApiUrl', this.$route.name) //当去当前路由API地址 赋值this.$store.state.CurrentUrl
            this.$http.get(this.$store.state.CurrentApiUrl).then((Response) => {
                this.$set(this, 'datas', Response.data) //获取页面数据赋值
            })
        }
    }

};
</script>
<style>
.check-tip {
    color: #95A5A6;
}
</style>
