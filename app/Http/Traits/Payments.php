<?php

namespace App\Http\Traits;

use App\Models\Payment;
use Exception;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Arr;

trait Payments
{
    public $trx;

    public function registrationPayment($email, $phone, $name){
        $random = Str::random(10);
        $date = Carbon::now();
        $d = $date->toArray();
        $this->trx = "TRX_".$d['timestamp'].$random.$d['micro'];
        try {
            //dd($this->trx);

            $response = Http::withHeaders([
                    "Authorization" => "Bearer FLWSECK_TEST-5bab936673a6f0fbb48fa0e60468aadc-X"
            ])->post('https://api.flutterwave.com/v3/payments', [
                'tx_ref' => $this->trx,
                'amount' => '2800',
                'currency' => 'NGN',
                "redirect_url" => "http://localhost:8000/verify",
                "customer" =>[
                    "email" => $email,
                    "phonenumber" => $phone,
                    "name" => $name
                ],
                "customizations" => [
                    "title" => "Studexs Payments",
                    "logo"=> "http://www.piedpiper.com/app/themes/joystick-v27/images/logo.png"
                ]
            ]);
            $p = $response->json();
            $u =  $p['data']['link'];
            
              //dd($u);
            return Redirect::to($u);

        }catch(Exception $e){

        }
    }

    public function verifyTransaction()
    {
        $u = URL::current();
        dd($u);
        $url = url()->full();
        $trx = parse_url($url);
        $tx_ref = $trx['query'];
        $r = explode('=', $tx_ref);
        // $tx_id = $trx['transaction_id']; 
        //dd($r['3']);
        try{
            $response = Http::withHeaders([
                "Authorization" => "Bearer FLWSECK_TEST-5bab936673a6f0fbb48fa0e60468aadc-X"
        ])->get('https://api.flutterwave.com/v3/transactions/verify_by_reference', [
            'tx_ref' => $r['3']]);
           $verify = $response->json();
           //dd($verify);
           if($verify['status'] == "success"){

            $verifyTx = new Payment();
            $verifyTx->tx_ef = $r['3'];
            $verifyTx->user_id = Auth::id();
            $verifyTx->save();

                return redirect()->to('/dashboard')->with('success', 'Payment Successfully');
           }elseif($verify['status'] != "success"){
            return redirect()->to('/dashboard')->with('error', 'Payment Unsuccessfully');
           }
        }catch(Exception $e){
            return $response->json($e);
        }
    }
}