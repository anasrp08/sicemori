<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    //
    protected $table = 'role_user';
    protected $fillable = [
        'role_id', 'user_id','user_type'
    ];
}
