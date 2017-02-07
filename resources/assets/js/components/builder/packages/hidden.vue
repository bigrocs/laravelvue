<template>
        <el-input
            type="hidden"
            :placeholder="datas.placeholder"
            :maxlength="datas.maxlength"
            :minlength="datas.minlength"
            :disabled="datas.disabled"
            :size="datas.size"
            :icon="datas.icon"
            :rows="datas.rows"
            :autosize="datas.autosize"
            :name="datas.name"
            :max="datas.max"
            :min="datas.min"
            :autofocus="datas.autofocus"
            :form="datas.form"
            v-model="datas.value">
        </el-input>
</template>
<script>
export default{
    props: {
        datas: {
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
            if (this.datas.value==null) {this.datas.value = ''}
        }
    }
}
</script>
