<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(\App\Http\Requests\UserStore $request)
    {
//        dd($request->all());
        $user = $request->validated();
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', ['user'=>$user]);
    }

    public function update($id, \App\Http\Requests\UserUpdate $request)
    {
        $user = $request->validated();
        $user = User::find($id);
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::find($id)->remove();
        return redirect()->route('users.index');
    }
}
