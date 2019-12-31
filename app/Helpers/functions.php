<?php

//设置Redis数据缓存
function redis()
{
    //实例化Redis类
    $redis = new Redis();
    //链接Redis数据库
    $redis->connect('127.0.0.1', 6379);
    //Redis数据库密码登录
    $redis->auth('kansz');
    //选择数据库1
    $redis->select(1);
    return $redis;
}

//删除文件
function delImage($url)
{
    if (!empty($url))
        unlink('.' . $url);
}

/**
 * [permission 检测是否有操作权限]
 * @return [type] [description]
 */
function permission()
{
    //获取当前的模块名、控制器名和方法名
    $curren_url = \Route::current()->getActionName();
    list($url, $action) = explode('@', $curren_url);
    $urlArr = explode('\\', $url);
    $module = $urlArr[3];
    $controller = $urlArr[4];
    $url = $module . '/' .$controller . '/' . $action;
    // 检验权限
    if ($url == 'admin/IndexController/index' || $url == 'admin/IndexController/welcome' || $url == 'admin/IndexController/no_permission')
        return true;
    // 取出用户的权限
    $auth = \Illuminate\Support\Facades\Session::get('auth');

    // 如果是超级boss直接返回
    if ($auth == 'all')
    {
        return true;
    } elseif (!empty($auth)) {
        // 把二维数组转成一维数组
        $result = array_column($auth, 'auth_link');
        if (in_array($url, $result))
            return true;
        else
            return false;
    } else {
        return false;
    }
}

/**
 * [getNav 后台管理左侧导航栏显示状态]
 * @param  [type]  $nav   [description]
 * @param  integer $leval [description]
 * @return [type]         [description]
 */
function getNav($nav = [], $leval = 0)
{

    // 取出用户的权限
    $auth = \Illuminate\Support\Facades\Session::get('auth');

    // 如果是超级boss直接返回
    if ($auth == 'all')
    {
        return '';
    } elseif (!empty($auth)) {
        // 把二维数组转成一维数组
        $result = array_column($auth, 'auth_link');
        $str = 'display: none;';
        foreach ($result as $key => $value) {
            if ($leval == 0)
            {
                foreach ($nav as $val) {
                    //判断字符串第一次出现的位置
                    if (strpos($value, $val))
                        $str = '';
                }
            } else {
                //判断字符串第一次出现的位置
                if (strpos($value, $nav[0] . '/' . $nav[1]))
                    $str = '';
            }
        }
        return $str;
    } else {
        return 'display: none;';
    }
}