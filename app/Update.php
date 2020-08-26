<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    //
    protected $table = 'tbl_update';
    protected $fillable = [
        'idLampiran',
        'keterangan',
        'order',
        'pecahan',
        'noseri'
        
        


       ];
}
