<template>
    <el-input
        v-if="datas.title"
        v-model="inputSearch"
        :placeholder="datas.title"
        @keyup.enter.native="handleInputConfirm"
        @blur="handleInputConfirm"
    >
        <el-select v-if="datas.select" v-model="selectSearch" slot="prepend" placeholder="请选择">
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
    data() {
      return {
          selectSearch: '',
          inputSearch: '',
      }
    },
    computed: {
        ...mapState({
            postData: 'postData',
            selectSearch: state => state.postData.selectSearch,
            inputSearch: state => state.postData.inputSearch,
        }),
    },
    watch: {
        selectSearch:'setSelectSearch',
    },
    methods: {
        /**
         * [setSelectSearch 选择搜索数据列]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:47:29+0800
         */
        setSelectSearch(){
            this.$store.dispatch('setPostData',{selectSearch:this.selectSearch})//设置搜索字段
        },
        /**
         * [handleInputConfirm 根据搜索获取数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:46:59+0800
         * @return   {[type]}                 [description]
         */
        handleInputConfirm(){
            this.$store.dispatch('setPostData',{inputSearch:this.inputSearch})//设置搜索内容
            this.$store.dispatch('getCurrentData',this.postData)//根据inputSearch获取数据
        }
    }
}
</script>