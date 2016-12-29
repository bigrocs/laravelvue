<?php

/**
 * Global helpers file with misc functions
 * 全局助手文件以及其他功能函数.
 */
if (!function_exists('getUploadUrl')) {
    /**
     * [getUploadUrl 根据ID获取上传文件对象单条URL信息].
     *
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-06-14T15:25:29+0800
     *
     * @param [type] $id [文件ID]
     *
     * @return [type] [description]
     */
    function getUploadWhereOne($id)
    {
        $UploadObject = new App\Models\Upload();
        return $UploadObject->getUploadWhereOne($id);
    }
}
if (!function_exists('bytesFormat')) {
    /**
     * [format_bytes 格式化字节大小].
     *
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-07-07T09:35:20+0800
     *
     * @param [type] $size      [字节数]
     * @param string $delimiter [数字和单位分隔符]
     *
     * @return [type] [格式化后的带单位的大小]
     */
    function bytesFormat($size, $delimiter = '')
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $size >= 1024 && $i < 5; ++$i) {
            $size /= 1024;
        }

        return round($size, 2).$delimiter.$units[$i];
    }
}
