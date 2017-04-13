<template>
    <el-form-item :label="config.label" :prop="config.name">
        <el-switch
            :disabled="config.disabled"
            :width="config.width"
            :on-icon-class="config.onIconClass"
            :off-icon-class="config.offIconClass"
            :on-text="onText"
            :off-text="offText"
            :on-color="onColor"
            :off-color="offColor"
            :name="config.name"
            v-model="value">
        </el-switch>
    </el-form-item>
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
          onText:   this.config.onText,
          offText:  this.config.offText,
          onColor:  this.config.onColor,
          offColor: this.config.offColor,
      };
    },
    created() {
        this.Initialization();
    },
    data() {
        return {
            value:false,
        };
    },
    watch: {
        datas:'Initialization',
        value:'setDatas'
    },
    methods:{
        Initialization(){
            let name = this.config.name
            if (this.config.value== 1) {
                this.value = true
            }else if (this.config.value== 0) {
                this.value = false
            }
            if (this.config.onText==null) {
                this.onText = '开启';
            }
            if (this.config.offText==null) {
                this.offText = '关闭';
            }
            if (this.config.onColor==null) {
                this.onColor = '#1abc9c';
            }
            if (this.config.offColor==null) {
                this.offColor = '#95a5a6';
            }
        },
        setDatas(){
            let name = this.config.name
            this.datas[name] = this.value
        }
    }
}
</script>
