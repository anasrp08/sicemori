<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdJenisPikai extends Model
{
    //
    protected $table = 'jenis_pikai';
    protected $fillable = [
        'jenis_pikai', 'keterangan'
       ];
}
