<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataTraining;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //

    public function index()
    {
        return view('register.index', [
            'tittle' => 'Daftar Akun'
        ]);
    }

    public function Store(Request $request)
    {
            $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required'
        ]);


        $validatedData['password'] = bcrypt($validatedData['password']);


       User::create($validatedData);

       return redirect()->back()->with('status', 'Berhasil Daftar! Silahkan kembali Untuk Login');
        
    }

}
