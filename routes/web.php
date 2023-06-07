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


Route::get('hasilmining', [DataTrainingController::class, 'hasilMining']);
Route::post('hasilmining', [DataTrainingController::class, 'pangkas']);
Route::get('hapusall', [DataTrainingController::class, 'hapusData']);
//importexport
Route::post('import', [DataTrainingController::class, 'import'])->name('import');

Route::post('importdatauji', [DataTrainingController::class, 'importDataUji'])->name('importDataUji');
//pohonkeputusan

Route::get('pohonkeputusan', [DataTrainingController::class, 'pohonkeputusan']);
Route::get('ujirule', [DataTrainingController::class, 'ujiRule']);
Route::get('bentuktree', [DataTrainingController::class, 'bentukTree']);
Route::get('/decision-tree', 'App\Http\Controllers\DataTrainingController@showDecisionTree');

Route::get('hitungakurasi', [DataTrainingController::class, 'hitungAkurasi']);



Route::get('/about', function () {
    return view ('about');
});




