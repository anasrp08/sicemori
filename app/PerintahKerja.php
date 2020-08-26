<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerintahKerja extends Model
{
    //
    protected $table = 'tbl_lpk';
    protected $fillable = [
        'no_lampiran_order',
        'pecahan',
        'status',
        'np',
        'created_by',
        'changed_by'
       ];
}
