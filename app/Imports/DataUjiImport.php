<?php

namespace App\Imports;

use App\Models\DataUji;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataUjiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataUji([
            'resi' => $row['resi'],
            'asuransi' => $row['asuransi'],
            'yesstar' => $row['yesstar'],
            'destinasi' => $row['destinasi'],
            'jumlahkiriman' => $row['jumlahkiriman'],
            'jeniskiriman' => $row['jeniskiriman'],
            'isikiriman' => $row['isikiriman'],
            'tepatwaktu_asli' => $row['tepatwaktu_asli'],
            'tepatwaktu_prediksi' => $row['tepatwaktu_prediksi'],
           

            
        ]);
    }
}
