<?php

namespace App\Imports;

use App\MDPetugas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAM

class MDPetugasImport implements ToModel, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MDPetugas([
            //
            
				'nama_petugas'  => $row['nama_petugas'],
                'np'            => $row['np'],
                'unit_kerja'    => $row['unit_kerja'],
                'instansi'      => $row['instansi']
        ]);
    }
    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }
}
