<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    //
    protected $table = 'tbl_pesanan';
    protected $fillable = [
        'jumlah_pesanan',
        'seri_terakhir',
        'pecahan',
        'tahun',
        'insit_persen',
        'order_terakhir',
        'nomor_terakhir',
        'jumlah_insit',
        'lembar_insit',
        'order_tnpinsit',
        'order_insit',
        'total_order',
        'total_pesanan',
        'np',
        'created_by',
        'changed_by'


       ];
}
