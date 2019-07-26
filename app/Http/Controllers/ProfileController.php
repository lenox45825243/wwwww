<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile', ['user' => $user]);
    }

    public function store(\App\Http\Requests\Profile $request)
    {
        $request->validated();
        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        return redirect()->back()->with('status', 'Профиль успешно обнавлён.');
    }
}
