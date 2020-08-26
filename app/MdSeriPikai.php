<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdSeriPikai extends Model
{
    //
    protected $table = 'seri_gol';
    protected $fillable = [
        'seri_gol','keterangan'
       ];
}
