<?php

namespace App\Models;

/**
 * trait CommonModel
 * @package App\Models
 */
trait CommonModel
{
	/**
	 * [page 分页模型]
	 * @param  [type] $skip [description]
	 * @param  [type] $take    [description]
	 * @return [type]         [description]
	 */
	public function page($skip,$take)
    {
		$skip = ($skip-1)*$take;
		return $this->skip($skip)->take($take);
    }

}
