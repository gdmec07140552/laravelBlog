<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $table = 'banner';

    protected $fillable = ['img_url', 'img_des', 'link_url', 'art_id', 'is_show', 'sort'];

    protected $primaryKey = 'banner_id';

    public $timestamps = false;
}
