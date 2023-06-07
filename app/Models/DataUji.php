<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class DataUji extends Model
{
    use HasFactory, Notifiable;
    
    protected $guarded = ['id'];
    protected $nullable = ['tepatwaktu_prediksi'];
}
