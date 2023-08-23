<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess()
    {
        $credentials = [
            'username' => request('username'),
            'password' => request('password')
        ];
        if (auth()->attempt($credentials)) {
            return redirect('admin/dashboard');
        }
        return back()->with('danger', 'Login Gagal');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
