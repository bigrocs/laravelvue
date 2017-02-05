<template>
<div class="row">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-tag
          v-for="tag in dynamicTags"
          :closable="true"
          :close-transition="false"
          type="success"
          @close="handleClose(tag)"
        >
        {{tag}}
        </el-tag>
        <el-input
          class="input-new-tag"
          v-model="inputValue"
          ref="saveTagInput"
          size="mini"
          placeholder="添加Tags"
          @keyup.enter.native="handleInputConfirm"
          @blur="handleInputConfirm"
        >
        </el-input>
    </div>
    <div class="col-md-6 col-sm-12">
        <span class="check-tip small">{{ datas.placeholder }}</span>
    </div>
</div>
</template>
<script>
export default {
    created() {
        this.dynamicTags = this.datas.value.toString().split(',')
    },
    data() {
      return {
        dynamicTags: [],
        inputValue: ''
      };
    },
    methods: {
      handleClose(tag) {
        this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
        this.datas.value = this.dynamicTags.join(',');
      },

      handleInputConfirm() {
        let inputValue = this.inputValue;
        let dynamicTags = this.dynamicTags;
        if (inputValue) {
            this.dynamicTags.push(inputValue);
            this.datas.value = dynamicTags.join(',');
        }
        this.inputValue = '';
      }
    },
    props: {
        datas: {
            type: Object,
            default: ''
        },
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
