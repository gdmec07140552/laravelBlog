<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * 关联到模型的数据表.
     *
     * @var array
     */
    protected $table = 'article';

    /**
     * 关联到模型的数据表主键.
     *
     * @var array
     */
    protected $fillable = [
        'art_title',
        'subtitle',
        'art_img',
        'author_id',
        'create_time',
        'cate_id',
        'tag_id',
        'is_show',
        'sort',
        'view',
        'content'
    ];

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $primaryKey = 'art_id';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
