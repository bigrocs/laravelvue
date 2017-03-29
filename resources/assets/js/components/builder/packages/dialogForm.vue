<template>
	<el-dialog size="large" :title="$store.state.dialogFormData.title" v-model="$store.state.dialogFormVisible">
        <builder-form :fromDatas="$store.state.dialogFormData"></builder-form>
    </el-dialog>
</template>
<script>
import builderForm from './../form.vue'
export default {
    components: {
    	builderForm,
    },
}
</script>