<template>
    <el-form-item :label="config.label" :prop="config.name">
        <el-tag
          v-for="(tag,key) in dynamicTags"
          :key="key"
          :closable="true"
          :close-transition="false"
          :style="tagStyle"
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
    </el-form-item>
</div>
</template>
<script>
export default {
    props: {
        datas: {
            type: '',
            default: ''
        },
        config: {
            type: Object,
            default: ''
        },
    },
    data() {
      return {
        dynamicTags: [],
        inputValue: '',
        tagStyle:{
            marginLeft:'10px' ,
            marginBottom:'10px' ,
        }
      };
    },
    created() {
        this.Initialization();
    },
    watch: {
        datas:'Initialization'
    },
    methods: {
        Initialization(){
            let name = this.config.name
            this.dynamicTags = this.datas[name].toString().split(',')
        },
        handleClose(tag) {
            let name = this.config.name
            this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
            this.datas[name] = this.dynamicTags.join(',');
        },

        handleInputConfirm() {
            let name = this.config.name
            let inputValue = this.inputValue;
            let dynamicTags = this.dynamicTags;
            if (inputValue) {
                this.dynamicTags.push(inputValue);
                this.datas[name] = dynamicTags.join(',');
            }
            this.inputValue = '';
        }
    },
  }
</script>
<style lang="css">
    .input-new-tag{
        width:78px !important;
        margin-left:10px !important;
    }
</style>
