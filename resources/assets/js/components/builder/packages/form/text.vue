<template>
    <el-form-item :label="config.label" :prop="name">
        <el-input
            type="text"
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
            v-model="datas[name]">
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
    data() {
        return {
            name: '',
        };
    },
    methods:{
        Initialization(){
            this.name = this.config.name
            if (this.datas[this.name]==null) {this.datas[this.name] = ''}
        }
    }
}
</script>
