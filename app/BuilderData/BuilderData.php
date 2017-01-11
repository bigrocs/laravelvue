<?php
namespace App\BuilderData;
/**
 * laravelVue数据构造器
 * @author BigRocs <bigrocs@qq.com>
 * @date   2016-05-08T13:51:33+0800
 */
class BuilderData
{
    private $data;            							// 数据

    /**
     * Form 方法
     */
     public function addFormData($formData){
         $this->data['form']['type']    = 'form';      //自动设置数据样式为 table
         $this->data['form']['datas']   = $formData;   //设置 table数据
         return $this;
     }
     /**
      * [addFormApiUrl 设置 FormApiUrl API通信网址]
      * @param [type] $key    [通信类型]
      * @param [type] $ApiUrl [通信网址]
      */
     public function addFormApiUrl($key,$ApiUrl){
         $this->data['form']['apiUrl'][$key]   = $ApiUrl;
         return $this;
     }
     public function addFormItem($formItem){
         $this->data['form']['datas'][]   = $formItem;
         return $this;
     }
     public function addFormTitle($title){
         $this->data['form']['title']   = $title;
         return $this;
     }
    /**
     * TableData方法
     */
    public function addTableData($tableData){
        $this->data['table']['type']    = 'table';      //自动设置数据样式为 table
        $this->data['table']['stripe']  = 'stripe';     //自动设置斑马纹
        $this->data['table']['datas']   = $tableData;   //设置 table数据
        return $this;
    }
    public function addTableColumn($tableColumn){
        $this->data['table']['column'][]   = $tableColumn;   //设置 tableColumn 表格柱
        return $this;
    }
    /**
     * [addTableApiUrl description]
     * @param [type] $key    [通信类型]
     * @param [type] $ApiUrl [通信网址]
     */
    public function addTableApiUrl($key,$ApiUrl){
        $this->data['table']['apiUrl'][$key]   = $ApiUrl;   //设置 TableApiUrl API通信网址
        return $this;
    }
    public function addTableTopButton($topButton){
        $this->data['table']['topButton'][]   = $topButton;   //设置 table rightButton 表格右侧按钮
        return $this;
    }
    public function addTableRightButton($rightButton){
        $this->data['table']['rightButton'][]   = $rightButton;   //设置 table rightButton 表格右侧按钮
        return $this;
    }


    /**
     * 公共方法
     */
     public function addTabs($tabs){
         $this->data['tabs']   = $tabs;   //设置 Tabs数据
         return $this;
     }
    public function get(){
        return $this->data;
    }
}
