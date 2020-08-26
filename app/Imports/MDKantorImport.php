<?php

namespace App\Imports;

use App\MDKantor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //
class MDKantorImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MDKantor([
            //
            
				'nama_kanwil'  => $row['nama_kanwil'],
                'wilayah'            => $row['wilayah'],
                'provinsi'    => $row['provinsi']
        ]);
    }
    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }
}
