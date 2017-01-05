<template>
<div class="row">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-switch
            :disabled="datas.disabled"
            :width="datas.width"
            :on-icon-class="datas.onIconClass"
            :off-icon-class="datas.offIconClass"
            :on-text="onText"
            :off-text="offText"
            :on-color="onColor"
            :off-color="offColor"
            :name="datas.name"
            v-model="datas.value">
        </el-switch>
    </div>
    <div class="col-md-6 col-sm-12">
        <span class="check-tip small">{{ datas.tip }}</span>
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
          onText:   this.datas.onText,
          offText:  this.datas.offText,
          onColor:  this.datas.onColor,
          offColor: this.datas.offColor,
      };
    },
    created() {
        if (this.datas.value == 1) {
            this.datas.value = true
        }else if (this.datas.value == 0) {
            this.datas.value = false
        }
        if (this.datas.onText==null) {
            this.onText = '开启';
        }
        if (this.datas.offText==null) {
            this.offText = '关闭';
        }
        if (this.datas.onColor==null) {
            this.onColor = '#1abc9c';
        }
        if (this.datas.offColor==null) {
            this.offColor = '#95a5a6';
        }
    }
}
</script>
