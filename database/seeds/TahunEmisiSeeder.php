<?php

use Illuminate\Database\Seeder;

class TahunEmisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $initTahun = 2000;

        for($i=15; $i<=20 ;$i++){
            DB::table('tbl_thn_emisi')->insert([
                'te'    => 'TE-'.$i,
                'tahun' => $initTahun+$i,
                'keterangan'=>''
            ]);

        }
    }
}
