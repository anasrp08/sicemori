<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LampiranOrder extends Model
{
    //
    protected $table = 'tbl_lampiran_order';
    protected $fillable = [
        'idpesanan',
        'no_lampiran',
        'pecahan',
        'ta',
        'tahun_emisi',
        'nomor_order',
        'seri',
        'nomor',
        'pemasok',
        'no_ba',
        'tanggal',
        'jmlh_kertas',
        'invoice',
        'keterangan',
        'lot_bi',
        'status',
        'np',
        'created_by',
        'changed_by'

       ];
}
