<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function send (Request $request)
    {
        $user = auth()->user();
        $msg = $request->message;
        $subject = $request->subject;

        if($msg == "" || $subject == "")
        {
            return back()->with(['alert' => 'Please fill in all fields.', 'alert_type' => 'error'])
                         ->withInput($request->all());        
        }

        Mail::send('mail.support', compact('user', 'msg'), function($mail) use ($user, $subject){
            $mail->from($user->email, $user->name);
            $mail->to('support@weteach.io')->subject('New Support Inquiry - ' . $subject);
        });

        return back()->with(['alert' => 'Your message was sent, we will get back to you as soon as possible.', 'alert_type' => 'success']);
    }
}
