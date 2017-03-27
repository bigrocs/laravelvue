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
        'name', 'email', 'password',
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
}
