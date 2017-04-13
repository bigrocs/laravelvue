<template>
    <el-form-item :label="config.label" :prop="config.name">
        <el-upload
          :class="config.class"
          :action="config.postUrl"
          :headers="headers"
          :multiple="config.multiple"
          :data="config.data"
          :name="config.fileName"
          :with-credentials="config.withCredentials"
          :show-file-list="config.showFileList"
          type="drag"
          :accept="config.accept"
          :on-preview="handlePreview"
          :on-remove="handleRemove"
          :on-success="handleSuccess"
          :on-error="handleError"
          :on-progress="handleProgress"
          :list-type="config.picture"
          :before-upload="beforeUpload"
          :auto-upload="true"
        >
          <img v-if="imageUrl" :src="imageUrl" :style="stylePicture" class="img-responsive" >
          <i v-else class="el-icon-plus" :style="stylePictureUploaderIcon"></i>
        </el-upload>
    </el-form-item>
</div>
</template>
<script>
export default{
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
          imageUrl: '',
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
            let name = this.config.name
            if (this.config.fileList) { this.imageUrl = this.config.fileList[0].url}
            if (!this.datas[name]) { this.datas[name] = '' }
            if (!this.config.fileName) { this.config.fileName = 'file' }
            if (!this.config.withCredentials) { this.config.withCredentials = false }
            if (!this.config.showFileList) { this.config.showFileList = false }
            if (!this.config.class) { this.config.class = 'picture-uploader' }
            // 上传文件大小显示语言提示beging
            if (!this.config.maxSizeLang) { this.config.maxSizeLang = {} }
            if (!this.config.maxSizeLang.title) { this.config.maxSizeLang.title = '文件大小超过限制' }
            if (!this.config.maxSizeLang.message) { this.config.maxSizeLang.message = '文件大小超过系统限制' }
            if (!this.config.maxSizeLang.type) { this.config.maxSizeLang.type = 'warning' }
            // 上传文件大小显示语言提示end
            //样式传参
            if (this.config.stylePictureUploaderIcon) { this.stylePictureUploaderIcon = this.config.stylePictureUploaderIcon }
            if (this.config.stylePicture) { this.stylePicture = this.config.stylePicture }
        },
        handleRemove(file, fileList) {
            let name = this.config.name
            this.datas[name] = null;
        },
         handlePreview(file) {
               // console.log(file);
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
                let name = this.config.name
                this.imageUrl = URL.createObjectURL(file.raw);
                this.datas[name] = Response.uploadData.id;
            }
            this.$notify({
                title: Response.title,
                message: Response.message,
                type: Response.type,
            });
        },
        handleError(err, response, file){
              // console.log(err, response, file);
        },
        handleProgress(event, file, fileList){
              // console.log(event, file, fileList);
        },
        beforeUpload(file){
          /**
           * [if 判断是否符合上传大小]
           * @author BigRocs
           * @email    bigrocs@qq.com
           * @DateTime 2017-03-06T14:54:48+0800
           * @param    {[type]}                 this.config.maxSize<file.size [description]
           * @return   {[type]}                                              [description]
           */
          if (this.config.maxSize<file.size) {
              this.$notify({
                  title: this.config.maxSizeLang.title,
                  message: this.config.maxSizeLang.message,
                  type: this.config.maxSizeLang.type,
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