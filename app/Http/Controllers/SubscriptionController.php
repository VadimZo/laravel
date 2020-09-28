<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function subs(Request $request)
    {
        $this->validate($request,[
           'email'=>'required|email|unique:subscriptions',
        ]);
       $subs=Subscription::create($request->all());
       $subs->generateToken();
       Mail::to($subs)->send(new VerifyMail($subs));
       return redirect()->back();
    }
    public function verify($token)
    {
        $subs=Subscription::where('token',$token)->firstOrFail();
        $subs->token = null;
        $subs->save();
        return redirect('/');
    }
}
