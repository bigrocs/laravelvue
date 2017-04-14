<?php
namespace App\Facades;
/**
 * laravelVue数据构造器
 * @author BigRocs <bigrocs@qq.com>
 * @date   2016-05-08T13:51:33+0800
 */
class BuilderData
{
    private $data;            							// 数据
    private $formItemType = [
            'hidden'     => '隐藏',
            'static'     => '不可修改文本',
            'number'        => '数字',
            'price'      => '价格',
            'text'       => '单行文本',
            'textarea'   => '多行文本',
            'array'      => '数组',
            'password'   => '密码',
            'radio'      => '单选按钮',
            'checkbox'   => '复选框',
            'select'     => '下拉框',
            'icon'       => '字体图标',
            'date'       => '日期',
            'datetime'   => '时间',
            'picture'    => '单张图片',
            'pictures'   => '多张图片',
            'file'       => '单个文件',
            'files'      => '多个文件',
            'kindeditor' => 'HTML编辑器 kindeditor',
            'editormd'   => 'Markdown编辑器 editormd',
            'tags'       => '标签',
            'board  '    => '拖动排序',
    ];            							               // form样式
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
    /**
     * [setFormObject 给form Item 列赋值value]
     * @param [type] $Object [传入数据]
     */
    public function setFormObject($Object){
         foreach ($this->data['form']['datas'] as &$item) {
                if (!isset($item['value'])) {
                    $item['value'] = $Object[$item['name']];
                }
         }
         return $this;
    }
    public function setFormTitle($title){
         $this->data['form']['title']   = $title;
         return $this;
    }
    public function setFormConfig($config){
         $this->data['form']['config']   = $config;
         return $this;
    }
    public function getformItemType(){
         return $this->formItemType;
    }
    /**
     * [setFormRules 设置form验证规则]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-04-04T11:41:52+0800
     * @param    [type]                   $rules [description]
     */
    public function setFormRules($rules){
        $this->data['form']['rules']   = $rules;
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
    public function setTablePagination($pagination){
        $this->data['table']['pagination']   = $pagination;
        return $this;
    }
    public function setSearchTitle($title){
        $this->data['table']['search']['title']   = $title;
        return $this;
    }
    public function setSearchSelect($select){
        $this->data['table']['search']['select']   = $select;
        return $this;
    }
    /**
     * 公共方法
     */
    public function setTabs($tabs){
         $this->data['tabs']   = $tabs;   //设置 Tabs数据
         return $this;
    }
    public function setTitle($title){
         $this->data['title']   = $title.' - LaravelCfm';   //设置 页面标题
         return $this;
    }
    public function get(){
        return $this->data;
    }
}
