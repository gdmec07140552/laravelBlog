<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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


    /*
     * 图片上传
     * */
    public function uploads(Request $request)
    {
        $file = $request->file('images');
        //判断文件是否有效
        if ($request->hasFile('images') && $file->isValid())
        {
            //图片格式
            $img_ext = ['png', 'jpg', 'jpeg', 'gif'];
            //判断图片的格式是否符合
            if (!in_array($file->getClientOriginalExtension(), $img_ext))
                return ['status' => 0, 'msg' => '图片格式不对'];
            //获取原文件名
            $originalName = $file->getClientOriginalName();
            //获取文件的扩展名
            $ext = $file->getClientOriginalExtension();
            //返回文件的mime类型。return string | null
            $type = $file->getMimeType();
            //临时文件路径
            $realPath = $file->getRealPath();
            //拼接文件名
            $filename = uniqid() . '.' . $ext;
            //图片真实路径
            $img_url = '/static/uploads/' . date('Ymd');
            //迁移文件到指定的路径
            $result = $file->storeAs($img_url, $filename);
            //图片全部路径
            $all_imgurl = asset($result);
            if ($result)
                return ['status' => 1, 'all_imgurl' => $all_imgurl, 'img_url' => '/' . $result];
            else
                return ['status' => 0, 'msg' => '图片上传失败'];
        } else {
            return ['status' => 0, 'msg' => '图片上传无效'];
        }
    }

    /*
     * 无权限展示
     * */
    public function no_permission()
    {
        return view('admin.index.no_permission')->with('js_array', []);
    }
}
