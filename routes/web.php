<?php

use App\Http\Controllers\DataTrainingController;
use App\Http\Controllers\LoginController;
use App\Models\DataTraining;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\PostDec;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





Route::get('datatraining',[DataTrainingController::class, 'index'])->middleware('auth');
Route::get('/mining',[DataTrainingController::class, 'mining'])->middleware('auth');
Route::post('datatraining',[DataTrainingController::class, 'Store'])->middleware('auth');
Route::get('/tampildata/{id}', [DataTrainingController::class, 'tampildata'])->middleware('auth');
Route::get('update/{id}', [DataTrainingController::class, 'update'])->middleware('auth');
Route::get('destroy/{id}', [DataTrainingController::class, 'destroy'])->middleware('auth');
Route::get('home', [DataTrainingController::class, 'home'])->middleware('auth');

//Autentikasi (login & logout)
Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);

//register
Route::get('register', [RegisterController::class, 'index']);
Route::post('register', [RegisterController::class, 'Store']);


Route::get('hasilmining', [DataTrainingController::class, 'hasilMining'])->middleware('auth');
Route::post('hasilmining', [DataTrainingController::class, 'pangkas'])->middleware('auth');
Route::get('hapusall', [DataTrainingController::class, 'hapusData'])->middleware('auth');
//importexport
Route::post('import', [DataTrainingController::class, 'import'])->name('import')->middleware('auth');

Route::post('importdatauji', [DataTrainingController::class, 'importDataUji'])->name('importDataUji')->middleware('auth');
//pohonkeputusan

Route::get('pohonkeputusan', [DataTrainingController::class, 'pohonkeputusan'])->middleware('auth');
Route::get('ujirule', [DataTrainingController::class, 'ujiRule'])->middleware('auth');
//Route::get('bentuktree', [DataTrainingController::class, 'bentukTree'])->middleware('auth');
Route::get('bentuktree', [DataTrainingController::class, 'bentuktree'])->middleware('auth');
Route::get('/decision-tree', 'App\Http\Controllers\DataTrainingController@showDecisionTree')->middleware('auth');

Route::get('hitungaku', [DataTrainingController::class, 'hitungAku'])->middleware('auth');
Route::get('hitungakurasi', [DataTrainingController::class, 'hitungAkurasi'])->middleware('auth');

Route::get('prediksi', [DataTrainingController::class, 'prediksi'])->middleware('auth');
Route::post('prediksi', [DataTrainingController::class, 'prosesPrediksi'])->middleware('auth');
Route::get('hapuspohon', [DataTrainingController::class, 'hapusPohon'])->middleware('auth');
Route::get('hapusdatauji', [DataTrainingController::class, 'hapusDatauji'])->middleware('auth');


Route::get('/about', function () {
    return view ('about');
});




