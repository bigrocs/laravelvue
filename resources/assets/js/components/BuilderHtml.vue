<template>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <!-- 引入builder快速组件页面 -->
                <builder></builder>
            </div>
        </div>
    </div>
</div>
</template>

<script>
/**
 * 注册Builder快速组件页面组件
 */
import Builder from './builder/index.vue'
export default {
    components: {
        Builder
    }
};
</script>
