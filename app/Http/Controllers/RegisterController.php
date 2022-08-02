<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar';
        
        return view('auth.register', $data);
    }
    
    public function register(Request $request)
    {
        $usedEmail = User::where('email', $request->email)->first();
        if($usedEmail != null)
        {
            return redirect()->back()->with('ERR', 'Email telah dgunakan.');
        }
        User::create([
           'name' => $request->name,
           'email' => $request->email,
           'role' => 'user',
           'phone_number' => $request->phone_number,
           'address' => $request->address,
           'proposer' => $request->proposer,
           'password' => bcrypt($request->password)
        ]);
        
        return redirect()->route('dashboard.index')->with('OK', 'Berhasil daftar akun.');
    }
}
