<?php

use Illuminate\Database\Seeder;
// use DB;
class PecahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=array(
           
                array('kode_pecahan'=>'S','nama_pecahan'=>'Rp. 1.000,-','max_kemas'=>'5000000','keterangan'=>''),
                array('kode_pecahan'=>'T','nama_pecahan'=>'Rp. 2.000,-','max_kemas'=>'5000000','keterangan'=>''),
                array('kode_pecahan'=>'U','nama_pecahan'=>'Rp. 5.000,-','max_kemas'=>'5000000','keterangan'=>''),
                array('kode_pecahan'=>'V','nama_pecahan'=>'Rp. 10.000,-','max_kemas'=>'4500000','keterangan'=>''),
                array('kode_pecahan'=>'W','nama_pecahan'=>'Rp. 20.000,-','max_kemas'=>'4500000','keterangan'=>''),
                array('kode_pecahan'=>'X','nama_pecahan'=>'Rp. 50.000,-','max_kemas'=>'4500000','keterangan'=>''),
                array('kode_pecahan'=>'Y','nama_pecahan'=>'Rp. 100.000,-','max_kemas'=>'4500000','keterangan'=>''),
            
        );

        DB::table('tbl_pecahan')->insert($data);
    }
    
}
