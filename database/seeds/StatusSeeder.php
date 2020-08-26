<?php

use Illuminate\Database\Seeder;
// use DB;
class StatusSeeder extends Seeder
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
            array('status'=>'0','keterangan'=>'Belum Terisi'),
            array('status'=>'1','keterangan'=>'Release Order'),
            array('status'=>'2','keterangan'=>'Dikerjakan'),
            array('status'=>'3','keterangan'=>'Selesai'),
            array('status'=>'4','keterangan'=>'Revisi'),
 
        );

        DB::table('tbl_status')->insert($data);
    }
    
}
