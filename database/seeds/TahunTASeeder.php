<?php

use Illuminate\Database\Seeder;

class TahunTASeeder extends Seeder
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

        for($i=18; $i<=20 ;$i++){
            DB::table('tbl_tahun')->insert([
                'ta'    => 'TA-'.$i,
                'tahun' => $initTahun+$i,
                'keterangan'=>''
            ]);

        }
    }
}
