<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'admin_role';

    protected $fillable = ['role_name', 'auth', 'is_show', 'description', 'sort'];

    protected $primaryKey = 'role_id';

    public $timestamps = false;
}
