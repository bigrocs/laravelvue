<template>
    <div>
        <el-tag
            v-for="tag in datas"
            type="success"
        >
            {{tag.display_name}}
        </el-tag>
    </div>
</template>
<script>
export default {
    props: {
        datas: {
            type: Array,
            default: ''
        },
        config: {
            type: Object,
            default: ''
        },
    },
    data() {
      return {
      };
    },
    created() {
      console.log(this.config);
    },
    methods: {

    },
  }
</script>
<style lang="css">
    .input-new-tag{
        width:78px !important;
        margin-left:10px !important;
    }
    .el-tag+.el-tag{
        margin-left:10px !important;
        margin-bottom:10px !important;
    }
</style>
