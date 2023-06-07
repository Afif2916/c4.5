<?php

namespace App\Imports;

use App\Models\DataTraining;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataTrainingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataTraining([
            'resi' => $row['resi'],
            'asuransi' => $row['asuransi'],
            'yesstar' => $row['yesstar'],
            'destinasi' => $row['destinasi'],
            'jumlahkiriman' => $row['jumlahkiriman'],
            'jeniskiriman' => $row['jeniskiriman'],
            'isikiriman' => $row['isikiriman'],
            'tepatwaktu' => $row['tepatwaktu'],

            
        ]);
    }
}
