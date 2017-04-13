<template>
    <el-form-item :label="config.label" :prop="config.name">
        <el-select
            type="text"
            :placeholder="config.placeholder"
            :multiple="config.multiple"
            :disabled="config.disabled"
            :size="config.size"
            :clearable="config.clearable"
            :multiple-limit="config.multipleLimit"
            :name="config.name"
            :filterable="config.filterable"
            :allow-create="config.allowCreate"
            :filter-method="config.filterMethod"
            :remote="config.remote"
            :remote-method="config.remoteMethod"
            :loading="config.loading"
            :loading-text="config.loadingText"
            :no-match-text="config.noMatchText"
            :no-data-text="config.noDataText"
            :popper-class="config.popperClass"
            v-model="value">
            <el-option
                v-for="(item,key) in config.options"
                :label="item"
                :key="key"
                :value="key.toString()">
            </el-option>
        </el-select>
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
            value:''
        };
    },
    created() {
        this.Initialization();
    },
    watch: {
        datas:'Initialization',
        value:'setDatas'
    },
    methods:{
        Initialization(){
            let name = this.config.name
            this.value = this.datas[name].toString()
            if (this.datas[name]==null) {this.value = ''}
        },
        setDatas(){
            let name = this.config.name
            this.datas[name] = this.value
        }
    }
}
</script>
