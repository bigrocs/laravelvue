<template>
    <el-input
        v-if="datas.title"
        v-model="$store.state.postData.inputSearch"
        :placeholder="datas.title"
        @keyup.enter.native="handleInputConfirm"
        @blur="handleInputConfirm"
    >
        <el-select v-if="datas.select" v-model="$store.state.postData.selectSearch" slot="prepend" placeholder="请选择">
            <el-option v-for="(label, value) in datas.select"  :key="value" :label="label" :value="value"></el-option>
        </el-select>
        <el-button slot="append" icon="search" @click="handleInputConfirm"></el-button>
    </el-input>
</template>
<script>
import { mapState } from 'vuex'
export default {
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
    computed: {
        ...mapState({
            postData: 'postData',
        }),
    },
    methods: {
        /**
         * [handleInputConfirm 根据搜索获取数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:46:59+0800
         * @return   {[type]}                 [description]
         */
        handleInputConfirm(){
            this.$store.dispatch('getCurrentData',this.postData)//根据inputSearch获取数据
        }
    }
}
</script>