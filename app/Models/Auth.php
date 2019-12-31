<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    //
    protected $table = 'admin_auth';

    protected $fillable = ['auth_name', 'auth_link', 'is_show', 'pid', 'sort'];

    protected $primaryKey = 'auth_id';

    public $timestamps = false;
}
