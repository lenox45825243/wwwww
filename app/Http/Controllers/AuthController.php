<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('pages.register');
    }

    public function register(\App\Http\Requests\AuthRegister $request)
    {
        $request->validated();
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));
        return redirect('/login');
    }

    public function loginForm()
    {
        return view('pages.login');
    }

    public function login(\App\Http\Requests\AuthLogin $request)
    {
        $request->validated();
        if(Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => 0
        ]))
        {
            return redirect('/');
        }
        return redirect()->back()->with('status', 'Неправильный логин или пароль, или вы забанены!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
