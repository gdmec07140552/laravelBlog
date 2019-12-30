<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /*
     * 首页显示
     * */
    public function index()
    {
        return view('admin.index.index')->with('js_array', ['layui', 'x-admin']);
    }

    /*
     * 首页欢迎页面
     * */
    public function welcome()
    {
        return view('admin.index.welcome')->with('js_array', ['layui', 'x-admin']);
    }
}
