<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAnggaran extends Model
{
    //
    protected $table = 'tbl_tahun';
    protected $fillable = [
        'idjadwal',
        'ta',
        'tahun',
        'keterangan',

       ];
}
