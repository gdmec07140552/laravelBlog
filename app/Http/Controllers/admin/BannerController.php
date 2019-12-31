<?php

namespace App\Http\Controllers\admin;

use App\Models\AdminLog;
use App\Models\Article;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 检测用户的基本权限
        if (!permission())
            return redirect('admin/no_permission');
        $result = Banner::orderby('sort', 'desc')->orderby('banner_id', 'desc')->paginate(10);
        //引入js文件
        return view('admin.banner.list')->with('result', $result)->with('js_array', ['layui', 'x-layui']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = Article::get();
        //引入js文件
        return view('admin.banner.add')->with('article', $article)->with('js_array', ['layui', 'x-layui']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取post提交过来的数据
        $input = $request->except('_token', 'images');
        $result = Banner::create($input);
        if ($result) {
            // 管理员日志记录
            AdminLog::addLog(1, '轮播管理', $result);
            return ['status' => 1, 'msg' => '添加成功'];
        } else {
            return ['status' => 0, 'msg' => '添加失败'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取所有文章
        $article = Article::get();
        //获取轮播图信息
        $result = Banner::where('banner_id', '=', $id)->first();
        return view('admin.banner.edit')->with('result', $result)->with('article', $article)->with('js_array', ['layui', 'x-admin']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //获取提交的数据
        $input = $request->except('_token', 'images');
        $banner = Banner::where('banner_id', '=', $input['banner_id'])->first();
        if (!$banner)
            return ['status' => 0, 'msg' => '修改失败'];
        $old_img = $banner['img_url'];
        $result = $banner->update($input);
        if ($result) {
            //修改成功把旧的图片删除
            if (!empty($input['img_url']) && $input['img_url'] != $old_img){
                delImage($old_img);
            }
            // 管理员日志记录
            AdminLog::addLog(2, '轮播管理', $input['banner_id']);
            return ['status' => 1, 'msg' => '修改成功'];
        } else {
            return ['status' => 0, 'msg' => '修改失败'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //获取提交数据
        $input = $request->except('_token');
        if (empty($input['banner_id']))
            return ['status' => 0, 'msg' => '删除失败'];
    }
}
