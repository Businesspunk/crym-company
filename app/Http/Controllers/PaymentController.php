<?php

namespace App\Http\Controllers;

use YandexCheckout\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Post;

class PaymentController extends Controller
{
    public function payForPomotion( Request $request )
    {   
        
        return $this->pay( [ 
                'post_id' => $request->post_id,
                'promotion_id' => $request->promotion_id
            ], 
            $request->desc, 
            (int) $request->cost 
        );
    }
    
    protected function pay( $metadata, $desc, $cost )
    {
        $client = new Client();
        $client->setAuth('678602', env('YANDEX_PUBLIC_KEY'));

        $args = [
            'amount' => [
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => 'https://krymskij.ru',
            ],
            'metadata' => $metadata,
            'capture' => true,
        ];

        $args['description'] = $desc;
        $args['amount']['value'] = $cost;

        $payment = $client->createPayment( $args, uniqid('', true) );

        $paymentUrl = $payment->confirmation->_confirmationUrl;

        return redirect( $paymentUrl );
    }

    public function successPayment( Request $request )
    {
        $data = $request->all()['object'];

        if( $data['status'] == 'succeeded' ){
            $metadata = $data['metadata'];
            $post = Post::findOrFail( (int) $metadata['post_id'] );
            $post->promote( (int) $metadata['promotion_id'] );
        }

        return 1;
        
    }
}
