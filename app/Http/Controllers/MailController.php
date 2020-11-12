<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailToAdmin;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\User;

class MailController extends Controller
{
    public function messageToAdmin( Request $rq )
    {
        $validator = Validator::make($rq->all(), [
            'g-recaptcha-response' => 'recaptcha',
        ]);
        
        if($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator, 'captcha')
                    ->withInput();
        }

        Mail::to( config('mail.admin') )->send(new MailToAdmin( $rq->all() ));
        return redirect()->back()->with('success', 'Заявка успешно отправлена.');
    }
}
