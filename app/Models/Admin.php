<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * 关联到模型的数据表.
     *
     * @var array
     */
    public $table = 'admin';

    /**
     * 关联到模型的数据表主键.
     *
     * @var array
     */
    public $primaryKey = 'admin_id';

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['admin_name', 'admin_pass', 'login_num', 'last_ip', 'last_time'];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
