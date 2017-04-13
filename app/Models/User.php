<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,EntrustUserTrait,CommonModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * [uploads 关联Upload模型]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-31T16:42:02+0800
     * @return   [type]                   [description]
     */
    public function userInfos()
    {
        return $this->hasOne('App\Models\UserInfo');
    }
    /**
     * [findForPassport API根据用户名查询用户信息]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-02-16T10:45:20+0800
     * @param    [type]                   $username [description]
     * @return   [type]                             [description]
     */
    public function findForPassport($username){
        return $this->where('name', $username)
                    ->orwhere('email',$username)
                    ->orwhere('mobile',$username)
                    ->first();
    }
    public function getRules(){
        $validatePassword = "
            (rule, value, callback) => {
                if (value === '') {
                  callback(new Error('请输入密码'));
                } else {
                  if (this.fromDatas.checkPassword !== '') {
                    this.\$refs.fromDatas.validateField('checkPassword');
                  }
                  callback();
                }
            }";
        $validateCheckPassword = "
            (rule, value, callback) => {
                if (value === '') {
                  callback(new Error('请再次输入密码'));
                } else if (value !== this.fromDatas.password) {
                  callback(new Error('两次输入密码不一致!'));
                } else {
                  callback();
                }
            }";
        $rules = [
            'name'=> [
                ['required' => true,  'message' => '请输入用户名', 'trigger'=> 'blur'],
                [ 'min'=> 4, 'max'=> 10, 'message'=> '长度在 4 到 10 个字符', 'trigger'=> 'blur' ]
            ],
            'email'=> [
                [ 'required'=> true, 'message'=> '请输入邮箱地址', 'trigger'=> 'blur' ],
                [ 'type'=> 'email', 'message'=> '请输入正确的邮箱地址', 'trigger'=> 'blur,change' ]
            ],
            // 'mobile'=> [
            //     [ 'required'=> true, 'message'=> '请输入手机号码', 'trigger'=> 'blur' ],
            //     [ 'min'=> 11, 'max'=> 11, 'type'=> 'number', 'message'=> '请输入正确的手机号码', 'trigger'=> 'blur,change' ]
            // ],
            'password'=> [
                [ 'required'=> true, 'validator'=> $validatePassword, 'trigger'=> 'blur', 'relation'=>'checkPassword' ]
            ],
            'checkPassword'=> [
                [ 'required'=> true, 'validator'=> $validateCheckPassword, 'trigger'=> 'blur', 'checkMessage'=>'两次输入密码不一致!', 'relation'=>'password' ]
            ]
        ];
        return $rules;
    }
}
