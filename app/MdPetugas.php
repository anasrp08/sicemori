<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdPetugas extends Model
{
    //
    protected $guarded = [];
    protected $table = 'mdpetugas';
    protected $fillable = [
        'nama_petugas', 'np', 'unit_kerja','instansi'
       ];
}
