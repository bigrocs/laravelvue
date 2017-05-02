<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Menu;
use Facades\ {
    App\Facades\BuilderMain
};
class MainController extends Controller
{
    /** @var menugModel */
    private $menuModel;

    public function __construct(Menu $menuRepo)
    {
        $this->menuModel = $menuRepo;
    }
    public function index()
    {
        $group = 'admin';
        $menus = $this->menuModel
                            ->orderBy('sort', 'ASC')
                            ->where('group', '=', $group)
                            ->where('status', '>=', 0)
                            ->get();
        // dd($menus);
        return $data =  BuilderMain::setRoutes($menus)
                            ->setMenus($menus)
                            ->setConfig('homeRouterNmae',  'api.admin.dashboard.index')
                            ->setConfig('loginRouterNmae', 'login')
                            ->setConfig('loginUrl', '/admin/login')
                            ->setApiUrl('logout',          '/admin/logout')
                            ->setApiUrl('login',           '/admin/login')
                            ->setApiUrl('authCheck',       '/admin/authCheck')
                            ->get();
    }
}
