<?php

namespace App\Models;
use App\CustomCollection;
use Illuminate\Database\Eloquent\Model;

use Facades\ {
    App\Facades\Helpers
};
/**
 * Class AdminConfig
 * @package App\Models
 */
class AdminConfig extends Model
{
    use CommonModel;
    public $table = 'admin_configs';

    public $fillable = [
        'title', 'name', 'value', 'group', 'type', 'icon', 'property', 'options', 'tip', 'sort', 'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'name' => 'string',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'name' => 'required|string',
        'value' => 'required|string'
    ]
    ;
    protected $appends = ['imageUrl','uploadUrl','label','rows'];
    /**
     * [getImageUrlAttribute 获取上传图片网址]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-04-16T08:40:27+0800
     * @return   [type]                   [description]
     */
    public function getImageUrlAttribute()
    {
        if ($this->attributes['type'] == 'picture') {
            $uploadObject = Helpers::getUploadWhereFirst($this->attributes['value']);
            return $uploadObject->url;
        }
    }
    /**
     * [getUploadUrlAttribute 获取上传文件路径]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-04-16T08:40:42+0800
     * @return   [type]                   [description]
     */
    public function getUploadUrlAttribute()
    {
        if ($this->attributes['type'] == 'picture') {
            return '/api/admin/system/upload/image';
        }
    }
    public function getLabelAttribute()
    {
        return $this->attributes['title'];
    }
    public function getRowsAttribute()
    {
        if ($this->attributes['type'] == 'textarea') {
            return 5;
        }
    }
}
