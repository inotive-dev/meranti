<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\EmailResetPassword;
use Mail;

class LoginController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';

        return view('auth.login', $data);
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user == null)
        {
            return redirect()->back()->with('ERR', 'Email tidak terdaftar');
        }
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials))
        {
            return redirect()->back()->with('ERR', 'Email dan password tidak cocok');
        }

        return redirect()->route('dashboard.index')->with('OK', 'Berhasil masuk ke dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('OK', 'Berhasil keluar dari dashboard');
    }

    public function forgetPassword(Request $request)
    {
      $user = User::where('email', $request['email'])->first();
      if ($user == null) {
        return redirect()->back()->with('ERR', 'Email Tidak Terdaftar');
      }
      $user->reset_token = bcrypt($user->id.$user->email);
      $user->save();
      $data['user'] = $user;
      $data['token'] = $user->reset_token;

      Mail::to($user->email)->send(new EmailResetPassword($data));
      return redirect()->back()->with('OK', 'Kami Telah Mengirim Link Penyetelan Ulang Password ke Email Anda');
    }

    public function forgetPasswordRedirect()
    {
      $user = User::find($_GET['id']);
      if ($user->reset_token == $_GET['token']) {
        return redirect('/reset-password/'.$_GET['id'])->with('OK', 'Selamat Datang di Form Penyetelan Ulang Password');
      }
      return abort('419');
    }

    public function indexResetPassword($id)
    {
      $data['title'] = 'Reset Password';

      if (!session('OK')) {
        return redirect()->route('login');
      }
      $data['user_id'] = $id;
      return view('auth.resetPassword', $data);
    }

    public function resetPassword(Request $request, $id)
    {
      $user = User::find($id);
      $new_token = bcrypt($user->id.$user->name.date('Y-m-d H:i:s'));
      $user->update([
      'password' => bcrypt($request['password']),
      'reset_token' => $new_token,
      ]);
      return redirect()->route('login')->with('OK', 'Password Telah Berhasil di Setel Ulang');
    }
}
