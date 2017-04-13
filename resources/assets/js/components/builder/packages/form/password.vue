<template>
    <el-form-item :label="config.label" :prop="config.name">
        <el-input
            type="password"
            :placeholder="config.placeholder"
            :maxlength="config.maxlength"
            :minlength="config.minlength"
            :disabled="config.disabled"
            :size="config.size"
            :icon="config.icon"
            :rows="config.rows"
            :autosize="config.autosize"
            :name="config.name"
            :max="config.max"
            :min="config.min"
            :autofocus="config.autofocus"
            :form="config.form"
            v-model="datas[config.name]">
        </el-input>
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
    created() {
        this.Initialization();
    },
    watch: {
        datas:'Initialization'
    },
    methods:{
        Initialization(){
            let name = this.config.name
            if (this.datas[name]==null) {this.datas[name] = ''}
        }
    }
}
</script>
