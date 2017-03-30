<template>
	 	<el-pagination
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :page-sizes="datas.pageSizes"
            :page-size="datas.pageSize"
            :layout="datas.layout"
            :total="datas.total">
        </el-pagination>
</template>
<script>
export default {
	props: {
        datas: {
            type: Object,
            default: ''
        },
    },
	methods: {
		/**
         * [handleSizeChange 设置每页显示数量并获取数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:48:22+0800
         * @param    {[type]}                 val [description]
         * @return   {[type]}                     [description]
         */
        handleSizeChange(val){
            this.$store.state.postData.pageSize = val;
            this.$store.dispatch('getCurrentData',this.postData)//根据pageSize获取数据
        },
        /**
         * [handleCurrentChange 根据页码获取页面数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-02-16T15:47:59+0800
         * @param    {[type]}                 val [description]
         * @return   {[type]}                     [description]
         */
        handleCurrentChange(val) {
            this.$store.state.postData.page = val;
            this.$store.dispatch('getCurrentData',this.postData)//根据page获取数据
        },
	}
}
</script>