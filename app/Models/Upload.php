<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Storage;

/**
 * Class Upload.
 */
class Upload extends Model
{

    public $table = 'uploads';

    public $fillable = [
        'uid',
        'name',
        'path',
        'url',
        'extension',
        'size',
        'md5',
        'sha1',
        'disk',
        'download',
        'sort',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
    ];

    /**
     * [$imageRules 验证图片格式].
     *
     * @var [type]
     */
    public static $imageRules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp',
    ];
    /**
     * [$imageMessages 验证图片错误返回信息].
     *
     * @var [type]
     */
    public static $imageMessages = [
        'file.mimes' => '上传图片格式错误',
        'file.required' => '图片不存在',
    ];

    /**
     * [$fileRules 验证文件格式].
     *
     * @var [type]
     */
    public static $fileRules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp',
    ];
    /**
     * [$fileMessages 验证文件错误返回信息].
     *
     * @var [type]
     */
    public static $fileMessages = [
        'file.mimes' => '上传文件格式错误',
        'file.required' => '文件不存在',
    ];

    /**
     * [imageUpload 上传图片模型].
     *
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-06-09T14:57:39+0800
     *
     * @param [type] $imageData [上传文件Input::all()数据]
     *
     * @return [type] [description]
     */
    public function imageUpload($imageData)
    {
        /**
         * [$validator 验证图片格式].
         *
         * @var [type]
         */
        $validator = Validator::make($imageData, self::$imageRules, self::$imageMessages);
        if ($validator->fails()) {
            return [
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400,
            ];
        }
        $response = $this->upload($imageData, 'images');

        return $response;
    }

    /**
     * [imageUpload 上传文件模型].
     *
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-06-09T14:57:39+0800
     *
     * @param [type] $imageData [上传文件Input::all()数据]
     *
     * @return [type] [description]
     */
    public function fileUpload($fileData)
    {
        /**
         * [$validator 验证文件格式].
         *
         * @var [type]
         */
        $validator = Validator::make($fileData, $this->$fileRules, $this->$fileMessages);
        if ($validator->fails()) {
            return [
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400,
            ];
        }
        $response = $this->upload($fileData, 'file');

        return $response;
    }

    /**
     * [upload 上传模型].
     *
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-06-14T15:45:59+0800
     *
     * @param [type] $fileData [文件数据]
     * @param [type] $mimeType [上传文件类型] [images,file]
     *
     * @return [type] [description]
     */
    public function upload($fileData, $mimeType)
    {
        //begin 获取上传文件数据
        $fileRealPath = $fileData['file']->getRealPath();
        $fileHashName = $fileData['file']->hashName();
        $fileInfo['uid'] = 0; //后期必须验证用户ID
        $fileInfo['size'] = $fileData['file']->getSize();
        $fileInfo['name'] = $fileData['file']->getClientOriginalName();
        $fileInfo['extension'] = $fileData['file']->getClientOriginalExtension();
        $fileInfo['md5'] = md5_file($fileRealPath);
        $fileInfo['sha1'] = sha1_file($fileRealPath);
        $fileInfo['download'] = 0;
        $fileInfo['status'] = 1;
        $fileInfo['sort'] = 0;
        $fileInfo['path'] = '/local/'.$mimeType.'/'.$fileHashName; //保存路径
        $fileInfo['disk'] = 'local'; //存储方式
        //end
        //begin查询文件是否存在
        $fileObject = $this->where('sha1', $fileInfo['sha1'])
                            ->where('md5', $fileInfo['md5'])
                            ->where('size', $fileInfo['size'])
                            ->first(); //end
        // 发现相同文件直接返回
        if ($fileObject) {
            return [
                'title' => '上传成功',
                'message' => '发现相同文件直接返回文件数据!',
                'uploadData' => $fileObject,
                'type'      => 'success',
            ];
        }
        $disk = Storage::disk($fileInfo['disk']);
        $storage = $disk->put(
            $fileInfo['path'],
            file_get_contents($fileRealPath)
        ); //保存文件

        if ($storage) {
            switch ($fileInfo['disk']) {
                case 'local':
                    $fileInfo['url'] = asset($fileInfo['path']);
                    break;

                default:
                    // code...
                    break;
            }//根据存储方式设置URL地址
            $uploadObject = $this->create($fileInfo); //把上传文件信息写入数据库
            return [
                'title' => '上传成功',
                'message' => '文件上传成功!',
                'uploadData' => $uploadObject,
                'type'      => 'success',
            ];
        } else {
            return [
                'title' => '上传失败',
                'message' => '文件上传失败!',
                'type'      => 'error',
            ];
        }
    }
    /**
     * [fileDelete 根据文件ID删除文件].
     *
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-07-19T10:59:03+0800
     *
     * @param [type] $ids [文件ID]
     *
     * @return [type] [description]
     */
    public function fileDelete($ids)
    {
        if (empty($ids)) {
            return [
                'message' => '请选择要操作的数据',
                'status' => 0,
                'code' => 200,
            ];
        }
        if (!is_array($ids)) {
            $ids = [$ids]; //转化为数组
        }
        //获取数据表主键
        $modelKeyName = $this->getKeyName();
        $fileObject = $this->whereIn($modelKeyName, $ids)->get();
        foreach ($fileObject as $key => $file) {
            Storage::delete($file->path);
        }
    }
    /**
     * [getUploadWhereOne 获取上传文件其中一个].
     *
     * @param [type] $id [文件ID]
     *
     * @return [type] [description]
     */
    public function getUploadWhereOne($id)
    {
        $uploadObject = $this->where(['id' => $id])->first();
        if (!$uploadObject) {
            $uploadObject = (object) [
                'name' => '未找到图片',
                'url' => asset('assets/apps/img/404.jpg'),
            ];
        }

        return $uploadObject;
    }
}
