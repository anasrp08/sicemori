<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengujian extends Model
{
    //
    protected $table = 'pengujian';
    protected $fillable = [
        'idjadwal',
        'iduji',
        'jumlah_sample',	
        'petugas',	
        'merk_bkckemasan',	
        'isi_bkcemasan',		
        'jenis_bkckemasan',	
        'pabrik_bkc',		
        'jenis_bkcpikai',	
        'seri_pikai',		
        'jenis_pikai',		
        'personalisasi',		
        'hje_pikai',			
        'isi_pikai',			
        'tarif_pikai',		
        'desain_tahun',		
        'ada_pikai',			
        'asli_pikai',		
        'baru_pikai',		
        'sesuai_pikai',		
        'peruntukan',		
        'pemilik_person',
        'nppbkc',
        'pengawas_person',

       ];
}
