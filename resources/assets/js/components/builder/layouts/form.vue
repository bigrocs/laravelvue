<template>
<div class="">
    {{ datas.apiUrl }}
</div>
</template>
<script>
export default{
    created() {
        console.log(this.datas);
    },
    props: {
        datas: {
            type: Object,
            default: ''
        },
    },
}
</script>
