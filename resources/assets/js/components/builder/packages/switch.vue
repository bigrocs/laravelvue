<template>
<div class="">
    <div class="col-md-12">
        <label>{{ datas.label }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <el-switch
            :disabled="datas.disabled"
            :width="datas.width"
            :on-icon-class="datas.onIconClass"
            :off-icon-class="datas.offIconClass"
            :on-text="datas.onText"
            :off-text="datas.offText"
            :on-color="datas.onColor"
            :off-color="datas.offColor"
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
          width:this.datas.width
      };
    },
    mounted(){
        if (this.datas.width==null) {
            this.width = 158;
            console.log(this.width);
        }
    }
}
</script>
