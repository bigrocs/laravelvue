<template>
<div class="row">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-upload
          :action="datas.postUrl"
          :headers="datas.headers"
          :multiple="datas.multiple"
          :data="datas.data"
          :name="datas.fileName"
          :with-credentials="datas.withCredentials"
          :show-upload-list="datas.showUploadList"
          type="drag"
          :thumbnail-mode="true"
          :on-preview="handlePreview"
          :on-remove="handleRemove"
          :on-success="handleSuccess"
          :on-error="handleError"
          :on-progress="handleProgress"
          :before-upload="beforeUpload"
          :default-file-list="fileList"
        >
          <i class="el-icon-upload"></i>
          <div class="el-dragger__text">将文件拖到此处，或<em>点击上传</em></div>
        </el-upload>
    </div>
    <div class="col-md-6 col-sm-12">
        <span class="check-tip small">{{ datas.placeholder }}</span>
    </div>
</div>
</template>
<script>
export default{
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
    data() {
      return {
        fileList: this.datas.fileList
      };
    },
    created() {
        if (this.datas.fileName==null) {
            this.datas.fileName = 'file';
        }
        if (this.datas.withCredentials==null) {
            this.datas.withCredentials = false;
        }
        if (this.datas.showUploadList==null) {
            this.datas.showUploadList = true;
        }
        // 上传文件大小显示语言提示beging
        if (this.datas.maxSizeLang==null) {
            this.datas.maxSizeLang = {};
        }
        if (this.datas.maxSizeLang.title==null) {
            this.datas.maxSizeLang.title = '文件大小超过限制';
        }
        if (this.datas.maxSizeLang.message==null) {
            this.datas.maxSizeLang.message = '文件大小超过系统限制';
        }
        if (this.datas.maxSizeLang.type==null) {
            this.datas.maxSizeLang.type = 'warning';
        }
        // 上传文件大小显示语言提示end
    },
    methods: {
      handleRemove(file, fileList) {
          this.datas.value = null;
      },
      handlePreview(file) {
        //   console.log(file);
      },
      handleSuccess(Response, file, fileList){
          if (Response.type=="success") {
              this.datas.value = Response.uploadData.id;
          }
          this.$notify({
              title: Response.title,
              message: Response.message,
              type: Response.type,
          });
      },
      handleError(err, response, file){
        //   console.log(err, response, file);
      },
      handleProgress(event, file, fileList){
        //   console.log(event, file, fileList);
      },
      beforeUpload(file){
          if (this.datas.maxSize<file.size) {
              this.$notify({
                  title: this.datas.maxSizeLang.title,
                  message: this.datas.maxSizeLang.message,
                  type: this.datas.maxSizeLang.type,
              });
              return false;
          }
      }
    }
}
</script>
