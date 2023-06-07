<?php

namespace App\Models;



class DataTraining 
{
    private static $data_training = [
        [
            "NomorResi" => "541990022423",
            "Asuransi" => "Yes",
            "Yes*" => "No",
            "Destinasi" => "Luar Pulau",
            "JumlahKiriman" => "1",
            "JenisKiriman" => "DangerousGoods",
            "IsiKiriman" => "Paket",
            "TepatWaktu" => "Tidak"

        ],
        [
            "NomorResi" => "541990022423",
            "Asuransi" => "Yes",
            "Yes*" => "No",
            "Destinasi" => "Luar Pulau",
            "JumlahKiriman" => "1",
            "JenisKiriman" => "General",
            "IsiKiriman" => "Paket",
            "TepatWaktu" => "Tidak"
        ]
    ];

    public static function all() 
    {
        return self::$data_training;
    }
}
