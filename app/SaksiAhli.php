<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaksiAhli extends Model
{
    //
    protected $table = 'saksiahli';
    protected $fillable = [
        'no_srtkantor', 'kantorpemohon', 'no_srtsidang','tgl_srtsidang','tgl_pelaksanasidang','status','pathfile'
       ];
}
 
