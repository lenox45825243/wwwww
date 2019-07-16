<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Mail\SubscribeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubsController extends Controller
{
    public function subscribe(\App\Http\Requests\Sub $request)
    {
        $request->validated();
        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();
        Mail::to($subs)->send(new SubscribeEmail($subs));
        return redirect()->back()->with('status','Проверьте вашу почту!');
    }

    public function verify($token)
    {
        $subs = Subscription::where('token', $token)->firstOrFail;
        $subs->token = null;
        $subs->save();
        return redirect('/')->with('status', 'Ваша почта подтверждена!');
    }
}
