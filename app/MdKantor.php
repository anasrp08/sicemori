<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdKantor extends Model
{
    //
    protected $table = 'mdkantor';
    protected $fillable = [
        'nama_kanwil', 'wilayah', 'provinsi'
       ];
}
