<?php
namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
	use CommonModel;

	protected $fillable = ['name', 'display_name', 'description'];
	/**
     * [getRules 前端验证规则]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-04-14T11:09:32+0800
     * @return   [type]                   [description]
     */
    public function getRules(){
        $rules = [
            'name'=> [
                ['required' => true,  'message' => '请输入权限标识', 'trigger'=> 'blur'],
                [ 'min'=> 4, 'max'=> 20, 'message'=> '长度在 4 到 20 个英文字符', 'trigger'=> 'blur' ]
            ],
            'display_name'=> [
                [ 'required'=> true, 'message'=> '请输入权限名称', 'trigger'=> 'blur' ],
            ],
            'description'=> [
                [ 'required'=> true, 'message'=> '请输入权限描述', 'trigger'=> 'blur' ],
            ],
        ];
        return $rules;
    }
}