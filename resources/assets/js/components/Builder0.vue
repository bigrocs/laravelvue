<template>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group" v-for="component in components">
                    <div v-if="component.name == 'input'" class="row">
                        <div class="col-md-12">
                            <label>{{ component.label }}</label>
                        </div>
                        <div class="col-md-6 col-sm-8">
                            <el-input
                                :type="component.type"
                                placeholder="请输入内容"
                                :number="true"
                                v-model="component.value">
                            </el-input>
                        </div>
                        <div class="col-md-6 col-sm-8">
                            <span class="check-tips small">{{ component.tips }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
  export default {

    data() {
      return {
        components: [
            {name: 'input',type:'text',value:'da',label:'网站口号:',tips:'网站口号、宣传标语、一句话介绍' },
            {name: 'input',type:'text',value:'1',label:'网站口号:',tips:'网站口号、宣传标语、一句话介绍' },
            {name: 'input',type:'textarea',value:'2',label:'网站口号:',tips:'网站口号、宣传标语、一句话介绍' },
            {name: 'input',type:'text',value:'3',label:'网站口号:',tips:'网站口号、宣传标语、一句话介绍' },
            {name: 'input',type:'textarea',value:'4',label:'网站口号:',tips:'网站口号、宣传标语、一句话介绍' },
            {name: 'input',type:'text',value:'5',label:'网站口号:',tips:'网站口号、宣传标语、一句话介绍'},
  		]
      };

    }
  };
</script>
<style>
    .check-tips{
        color:#95A5A6;
    }
</style>
