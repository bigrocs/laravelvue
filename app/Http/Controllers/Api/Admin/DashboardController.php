<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'form' => [
                'type'    => 'form',
                'url'     => 'api/admin/system',
                'method'  => 'post',
                'datas'   => [
                ]
            ]
        ];

        return response()->json($data, 200);
    }
}
