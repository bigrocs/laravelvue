<?php

namespace App\Models;
use App\CustomCollection;
use Illuminate\Database\Eloquent\Model;

use Facades\ {
    App\Facades\Helpers
};
class UserInfo extends Model
{

	/**
	 * [getAvatarAttribute 根据ID获取头像图片URL]
	 * @author BigRocs
	 * @email    bigrocs@qq.com
	 * @DateTime 2017-04-01T13:51:44+0800
	 * @param    [type]                   $value [头像图片ID]
	 * @return   [type]                          [description]
	 */
    public function getAvatarAttribute($id)
    {
    	$uploadObject = Helpers::getUploadWhereFirst($id);
        return $uploadObject->url;
    }
}
