<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Upload;


class UploadController extends Controller
{
    /** @var AdminConfigRepository */
    private $UploadModel;

    public function __construct(Upload $UploadRepo)
    {
        $this->UploadModel = $UploadRepo;
    }
    public function index()
    {

    }
    /**
     * [postImageUpload 图片上传].
     *
     * @Author   BigRocs                  BigRocs@qq.com
     * @DateTime 2016-06-09T12:00:52+0800
     *
     * @return [type] [description]
     */
    public function postImage()
    {
        $imageData = Input::all();
        $response = $this->UploadModel->imageUpload($imageData);

        return response()->json($response, 200);
    }
}
