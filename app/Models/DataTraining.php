<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class DataTraining extends Model
{
    use HasFactory, Notifiable;

   // protected $table = ['data_trainings'];
 //   protected $fillable = [
  //      'resi',
   //     'asuransi',
    //    'yesstar',
     //   'destinasi',
      //  'jumlahkiriman',
       // 'jeniskiriman',
       // 'isikiriman',
       // 'tepatwaktu'
    //];
    
    protected $guarded = ['id'];

   


    

    
}



