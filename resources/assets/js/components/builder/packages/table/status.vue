<template>
    <el-tag :type="tags.type">
        <i :class="tags.icon"></i>
        {{tags.title}}
    </el-tag>
</template>
<script>
export default {
    props: {
        datas: {
            type: '',
            default: ''
        },
    },
    data() {
        return {
            tags:{}
        };
    },
    created() {
        this.compileData()
    },
    watch: {
        datas: 'compileData',
    },
    methods: {
        /**
         * [compileData 编译数据]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-03-28T15:49:26+0800
         * @return   {[type]}                 [description]
         */
        compileData(){
            switch(this.datas) {
                case -1:
                    this.tags = {
                        'type':'danger',
                        'icon':'fa fa-trash',
                        'title':'删除',
                    };
                    break;
                case 0:
                    this.tags = {
                        'type':'warning',
                        'icon':'fa fa-ban',
                        'title':'禁用',
                    };
                    break;
                case 1:
                    this.tags = {
                        'type':'success',
                        'icon':'fa fa-check',
                        'title':'正常',
                    };
                    break;
                case 2:
                    this.tags = {
                        'type':'warning',
                        'icon':'fa fa-eye-slash',
                        'title':'隐藏',
                    };
                    break;
            }
        }
    },
  }
</script>

