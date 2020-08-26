<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revisi extends Model
{
    //
    protected $table = 'tbl_revisi';
    protected $fillable = [
        'idlampiran',
        'idpesanan',
        'no_lampiran',
        'level',
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
        'lini',
        'revisi',
        'catatan',
        'lot_bi',
        'status',
        'np',
        'created_by',
        'changed_by'
       ];
}
