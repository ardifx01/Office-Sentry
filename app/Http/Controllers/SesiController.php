<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // Set session variable to indicate user has logged in
            session(['first_time_login' => true]);
        }

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'pengawas') {
                return redirect('dashboard/pengawas')->with('success', 'Anda berhasil login');
            } elseif (Auth::user()->role == 'kabag_urdal') {
                return redirect('dashboard/kabag_urdal')->with('success', 'Anda berhasil login');
            } elseif (Auth::user()->role == 'office_boy') {
                return redirect('dashboard/office-boy')->with('success', 'Anda berhasil login');
            }

        } else {
            return redirect('/login')->withErrors('Username dan Password yang dimasukan tidak valid')->withInput();
        }

    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}