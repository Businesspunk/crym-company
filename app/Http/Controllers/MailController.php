<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailToAdmin;
use Mail;

class MailController extends Controller
{
    public function messageToAdmin( Request $rq )
    {
        Mail::to( env('ADMIN_MAIL') )->send(new MailToAdmin( $rq->all() ));
        return redirect()->back()->with('success', 'Заявка успешно отправлена.');
    }
}
