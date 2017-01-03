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
    public function addRightButton($rightButton){
        $this->data['table']['rightButton'][]   = $rightButton;   //设置 table rightButton 表格右侧按钮
        return $this;
    }


    /**
     * 公共方法
     */
    public function get(){
        return $this->data;
    }
}
