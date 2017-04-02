<template>
<div class="row">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-upload
          :class="datas.class"
          :action="datas.postUrl"
          :headers="headers"
          :multiple="datas.multiple"
          :data="datas.data"
          :name="datas.fileName"
          :with-credentials="datas.withCredentials"
          :show-file-list="datas.showFileList"
          type="drag"
          :accept="datas.accept"
          :on-preview="handlePreview"
          :on-remove="handleRemove"
          :on-success="handleSuccess"
          :on-error="handleError"
          :on-progress="handleProgress"
          :list-type="datas.picture"
          :before-upload="beforeUpload"
          :auto-upload="true"
        >
          <img v-if="imageUrl" :src="imageUrl" :style="stylePicture" class="img-responsive" >
          <i v-else class="el-icon-plus" :style="stylePictureUploaderIcon"></i>
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
          imageUrl: this.datas.fileList[0].url,
          headers:window.axios.defaults.headers.common,
          /**
           * [style下面是样式定义]
           */
          stylePictureUploaderIcon:{
                fontSize: '28px',
                color: '#8c939d',
                width: '178px',
                height: '178px',
                lineHeight: '178px',
                textAlign: 'center',
          },
          stylePicture:{
            padding:'0.07in'
          }
      }
    },
    created() {
        this.Initialization();
    },
    watch: {
        datas:'Initialization'
    },
    methods: {
        Initialization(){
            if (!this.datas.value) { this.datas.value = '' }
            if (!this.datas.fileName) { this.datas.fileName = 'file' }
            if (!this.datas.withCredentials) { this.datas.withCredentials = false }
            if (!this.datas.showFileList) { this.datas.showFileList = false }
            if (!this.datas.class) { this.datas.class = 'picture-uploader' }
            // 上传文件大小显示语言提示beging
            if (!this.datas.maxSizeLang) { this.datas.maxSizeLang = {} }
            if (!this.datas.maxSizeLang.title) { this.datas.maxSizeLang.title = '文件大小超过限制' }
            if (!this.datas.maxSizeLang.message) { this.datas.maxSizeLang.message = '文件大小超过系统限制' }
            if (!this.datas.maxSizeLang.type) { this.datas.maxSizeLang.type = 'warning' }
            // 上传文件大小显示语言提示end
            //样式传参
            if (this.datas.stylePictureUploaderIcon) { this.stylePictureUploaderIcon = this.datas.stylePictureUploaderIcon }
            if (this.datas.stylePicture) { this.stylePicture = this.datas.stylePicture }
        },
        handleRemove(file, fileList) {
            this.datas.value = null;
        },
         handlePreview(file) {
               console.log(file);
         },
         handleSuccess(Response, file, fileList){
            /**
             * [if 上传成功定义显示图片赋值ID]
             * @author BigRocs
             * @email    bigrocs@qq.com
             * @DateTime 2017-03-07T09:46:41+0800
             * @param    {[type]}                 Response.type [description]
             * @return   {[type]}                               [description]
             */
            if (Response.type=="success") {
                this.imageUrl = URL.createObjectURL(file.raw);
                this.datas.value = Response.uploadData.id;
            }
            this.$notify({
                title: Response.title,
                message: Response.message,
                type: Response.type,
            });
        },
        handleError(err, response, file){
              console.log(err, response, file);
        },
        handleProgress(event, file, fileList){
              console.log(event, file, fileList);
        },
        beforeUpload(file){
          /**
           * [if 判断是否符合上传大小]
           * @author BigRocs
           * @email    bigrocs@qq.com
           * @DateTime 2017-03-06T14:54:48+0800
           * @param    {[type]}                 this.datas.maxSize<file.size [description]
           * @return   {[type]}                                              [description]
           */
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
<style>
  .picture-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .picture-uploader .el-upload:hover {
    border-color: #20a0ff;
  }
</style>