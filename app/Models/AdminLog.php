<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminLog extends Model
{
    /**
     * 关联到模型的数据表.
     *
     * @var array
     */
    protected $table = 'admin_log';

    /**
     * 关联到模型的数据表主键.
     *
     * @var array
     */
    protected $primaryKey = 'log_id';

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['type', 'admin_name', 'login_ip', 'log_content', 'crate_time'];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /*
     * 添加管理员日志
     * */
    public static function addLog($type = 0, $name = '', $id = 0)
    {
        $user = session('user');
        $content = '';
        if ($type == 0)
            $content = '管理员登录';
        if ($type == 1)
            $content = '添加了' . $name . 'ID为' . $id . '的数据';
        if ($type == 2)
            $content = '编辑了' . $name . 'ID为' . $id . '的数据';
        if ($type == 3)
            $content = '删除了' . $name . 'ID为' . $id . '的数据';
        $data = [
            'admin_name' => $user['admin_name'],
            'type' => $type,
            'login_ip' => $_SERVER['REMOTE_ADDR'],
            'log_content' => $content,
            'create_time' => time()
        ];

        return Db::table('admin_log')->insert($data);
    }
}
