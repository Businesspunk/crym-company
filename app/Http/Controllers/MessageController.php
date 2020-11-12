<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dialog;
use App\Models\Message;
use App\Models\MessagesNotification;
use App\Helpers\Images\PhotoManager;
use Breadcrumbs;

class MessageController extends Controller
{
    public function messages( Request $request )
    {
        $user = $request->user();

        if( $user->messagesNotification ){
            $user->messagesNotification->delete();
        }
        
        $dialogs = $user->dialogs();

        return view('my-messages', [
            'dialogs' => $dialogs,
            'breadcrumbs' => Breadcrumbs::render('my_messages')
        ]); 
    }

    public function writeMessage( Request $request, $to, $post_id = null ){
        $user = $request->user();

        $dialogs = $user->getDialog( $to );

        if( $dialogs->count() == 0 ){
            $dialog = Dialog::create([
                'one_side_id' => $user->id,
                'other_side_id' => $to,
                'post_id' => $post_id
            ]);
            $dialogs = collect( [$dialog] );
        }

        return view('my-messages', [
            'dialogs' => $dialogs
        ]);
    }

    public function send( Request $request )
    {
        $dialog = Dialog::findOrFail( $request->dialog );
        $author_id = $request->user()->id;

        if( !$dialog->isParticipant( $author_id  ) ){
           abort(404);  
        }

        $arg = [
            'message' => $request->message,
            'dialog_id' => $dialog->id,
            'user_id' => $author_id,
        ];
        
        if( $request->fileMessage ){
            $path = PhotoManager::savePhoto( $request->file('fileMessage'), 'posts' );
            $arg['isPhoto'] = true;
            $arg['message'] = $path;
        }

        Message::create($arg);

        $oponent = $dialog->getOponent($author_id);
        MessagesNotification::makeNotification($oponent->id);

        return redirect()->back();
    }
}
