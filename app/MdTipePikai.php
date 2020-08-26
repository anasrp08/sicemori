<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdTipePikai extends Model
{
    //
    protected $table = 'tipe_pikai';
    protected $fillable = [
        'jenis_pikai','keterangan'
       ];
}
