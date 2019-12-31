<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use App\Models\AdminLog;
use App\Models\Auth;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //登录页面显示
    public function login()
    {
        return view('admin.login.login');
    }

    // 登录验证
    public function login_to(Request $request)
    {
        $input = $request->except('_token');
        //redis键名
        $key_name = 'error_num_' . $input['admin_name'];
        //用户的密码错误次数判断
        if (Redis::get($key_name) >= 5) return ['status' => 0, 'msg' => '您错误的次数已超过5次，请明天再试'];

        // 取出配置文件中密码拼接字段
        $pass_str = config('blogConf.pass_str');
        $input['admin_pass'] = md5($pass_str . $input['admin_pass']);
        $input['is_show'] = 0;
        $res = Admin::where($input)->first();
        if ($res)
        {
            // 1.登录成功更新用户的登录数据
            $res->last_time = time();
            $res->last_ip = $_SERVER['REMOTE_ADDR'];
            $res->login_num = $res['login_num'] + 1;
            $res->save();
            // 2.登录成功把用户基本信息保存到session中
            $request->session()->put('user', $res);
            // 3.管理员日志记录
            AdminLog::addLog();
            // 4.保存用户的基本权限
            $this->setPermission($request);

            return ['status' => 1, 'msg' => '登录成功'];
        } else {
            //用户的密码错误次数记录
            $login_error_num = Redis::incr($key_name);
            Redis::expire($key_name, 86400);
            return ['status' => 0, 'msg' => '用户名或密码错误'];
        }
    }

    /**
     * [setPermission 保护用户的权限信息]
     * @param [type] $user [description]
     */
    protected function setPermission($request)
    {
        $user = Session::get('user');
        if ($user['admin_id'] == 1)
        {
            // 超级管理员，大boss给所有权限
            $request->session()->put('auth', 'all');
        } else {
            if ($user['role_id'] > 0)
            {
                // 获取角色下拥有的权限
                $role = Role::where('role_id', '=', $user['role_id'])->value('auth');
                $idArr = explode(',', $role);
                $where['auth_id'] = ['in', $idArr];
                $authObject = Auth::whereIn('auth_id', $idArr)->get(['auth_link']);
                foreach ($authObject as $value)
                {
                    $auth[] = $value['auth_link'];
                }
                $request->session()->put('auth', $auth);
            } else {
                $request->session()->put('auth', '');
            }

        }

        return Session::get('auth');
    }

    /*
     * 退出登录
     * */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('admin/login');
    }
}
