<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Wallet;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Http\Traits\CryptoBalance;

class WalletsController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;
    //
    use CryptoBalance;
    public function myWallets(Request $request)
    {
        $user_id = $request->input('userId');
        $wallets = Wallet::where('user_id',$user_id)->get();
        return response()->json(["status" => $this->successStatus, "data"=> $wallets])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    }
    public function createWallet(Request $request)
    {

        
        $coin = $request->input('coin_type');
        $user_id = $request->input('userId');

        try {
            if (Wallet::where('coin_type',$coin)->where('user_id',$user_id)->exists()) {

                $cryptobalance = $this->balance($user_id);
                return response()->json(["status" => $this->successStatus, "message"=> "Wallet Already Exists"])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);

            }else{
                if($coin == 'BTC'){
                    $response = Http::get('https://tradaxs-api.herokuapp.com/btc');
                    $btc = $response->json();

                    $w = new wallet();
                    $w->coin_type = "BTC";
                    $w->uid = $btc['privateKey'];
                    $w->address = $btc['address'];
                    $w->user_id = $user_id;
                    $w->save();

                    return response()->json(["status" => $this->successStatus, "user"=> $w])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
                }elseif($coin == 'ETH'){
                    $response = Http::get('https://tradaxs-api.herokuapp.com/eth');
                    $eth = $response->json();

                    $w = new wallet();
                    $w->coin_type = "ETH";
                    $w->uid = $eth['privateKey'];
                    $w->address = $eth['address'];
                    $w->user_id = $user_id;
                    $w->save();

                    return response()->json(["status" => $this->successStatus, "user"=> $w])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
                }elseif($coin == 'BCH'){
                    $response = Http::get('https://tradaxs-api.herokuapp.com/bch');
                    $bch = $response->json();

                    $w = new wallet();
                    $w->coin_type = "BCH";
                    $w->uid = $bch['privateKey'];
                    $w->address = $bch['address'];
                    $w->user_id = $user_id;
                    $w->save();

                    return response()->json(["status" => $this->successStatus, "user"=> $w])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
                }elseif($coin == 'LTC'){
                    $response = Http::get('https://tradaxs-api.herokuapp.com/ltc');
                    $ltc = $response->json();

                    $w = new wallet();
                    $w->coin_type = "LTC";
                    $w->uid = $ltc['privateKey'];
                    $w->address = $ltc['address'];
                    $w->user_id = $user_id;
                    $w->save();

                    return response()->json(["status" => $this->successStatus, "user"=> $w])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
                }elseif($coin == 'DOGE'){
                    $response = Http::get('https://tradaxs-api.herokuapp.com/doge');
                    $doge = $response->json();

                    $w = new wallet();
                    $w->coin_type = "DOGE";
                    $w->uid = $doge['privateKey'];
                    $w->address = $doge['address'];
                    $w->user_id = $user_id;
                    $w->save();

                    return response()->json(["status" => $this->successStatus, "user"=> $doge])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
                }elseif($coin == 'BNB'){
                    $response = Http::get('https://tradaxs-api.herokuapp.com/bnb');
                    $bnb = $response->json();

                    $w = new wallet();
                    $w->coin_type = "BNB";
                    $w->uid = $bnb['privateKey'];
                    $w->address = $bnb['address'];
                    $w->user_id = $user_id;
                    $w->save();

                    $usdt = new wallet();
                    $usdt->coin_type = "USDT";
                    $usdt->uid = $bnb['privateKey'];
                    $usdt->address = $bnb['address'];
                    $usdt->user_id = $user_id;
                    $usdt->save();

                    $btcb = new wallet();
                    $btcb->coin_type = "BTCB";
                    $btcb->uid = $bnb['privateKey'];
                    $btcb->address = $bnb['address'];
                    $btcb->user_id = $user_id;
                    $btcb->save();

                    return response()->json(["status" => $this->successStatus, "user"=> [$w,$usdt,$btcb]])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
                }else{
                    return response()->json(["status" => $this->failedStatus,'error' => 'Invalid Data'], 401);
                }
            }
        } catch (Exception $e) {
            return $e;
        }
    }
    public function sendTrx(Request $request){
        
        $coin = $request->input('coin_type');
        $user_id = $request->input('userId');
        try {
            //code...
        
        if($coin == 'USDT')
        {
            $wallet = Wallet::where('coin_type','USDT')->where('user_id',$user_id)->first();
             $hed = [
              'Content-Type' => 'application/json',
              ];
            $response = Http::withHeaders($hed)->bodyFormat('json')->get('https://tradaxs-api.herokuapp.com/send',[
            'toAddress' => $request->input('address'),
            'fromAddress' => $wallet->address,
            'pkey' => $wallet->uid,
            'amount' => $request->input('amount')
            ]);
            $tx = $response->json();
       
            $fees = "0.0024";
            $am = $request->input('amount');
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnbtx',[
            'holder' => '0x753A5aFE4bD69fbf7F465F5e7Fae25B4080AC2Ca',
            'pkey' => $wallet->uid,
            'amount' => $fees,
            'gprice' => "20000000000",
            'gas' => "21000",
            ]);
            $txfees = $response->json();
            $st = $response->status();
        
            $t = $fees + $am;
        //dd($st,$txfees,$tx);
        $balance = $wallet->balance;
            if($t < $balance){
                return response()->json(["status" => $this->failedStatus,'error' => 'Insufficent Fund'], 401);
            }elseif($st == 404){
                return response()->json(["status" => $this->failedStatus,'error' => 'Insufficent Fund'], 401);
                
            }elseif($st == 200){
                
                $transaction = new Transaction();
            $transaction->currency_symbol = $wallet->coin_type;
            $transaction->sentTo = $request->input('address');
            $transaction->amount = $request->input('amount');
            $transaction->user_id = Auth::id();
            $transaction->save();
            return response()->json(["status" => $this->successStatus, "data"=> $transaction, "message" => "Transaction Successfully"])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    
            }
        }elseif($coin == "BNB"){
            $wallet = Wallet::where('coin_type','BNB')->where('user_id',Auth::id())->first();
      
            //0x753A5aFE4bD69fbf7F465F5e7Fae25B4080AC2Ca
           $hed = [
                  'Content-Type' => 'application/json',
                  ];
            $amount = $request->input('amount');
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnbtx',[
                'holder' => $request->input('address'),
                'pkey' => $wallet->uid,
                'amount' => $amount,
                'gprice' => "20000000000",
                'gas' => "21000",
                ]);
            $tx = $response->json();
            
            $fees = "0.0024";
            
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnbtx',[
                'holder' => '0x753A5aFE4bD69fbf7F465F5e7Fae25B4080AC2Ca',
                'pkey' => $wallet->uid,
                'amount' => $fees,
                'gprice' => "20000000000",
                'gas' => "21000",
                ]);
            $txfees = $response->json();
            //dd($tx);
            $st = $response->status();
            
            
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnb-balance',[
                'balance' => $wallet->address
                ]);
            $dd = $response->json();
            
            $t = $amount + $fees;
            
            $balance = $wallet->balance;
            
            if($t < $balance){
                return response()->json(["status" => $this->failedStatus,'error' => 'Insufficent Fund'], 401);
            }elseif($st == 404){
                return response()->json(["status" => $this->failedStatus,'error' => 'Insufficent Fund'], 401);
            }elseif($st == 200){
                
                $transaction = new Transaction();
            $transaction->currency_symbol = $wallet->coin_type;
            $transaction->sentTo = $request->input('address');
            $transaction->amount = $request->input('amount');
            $transaction->user_id = Auth::id();
            $transaction->save();
            
            return response()->json(["status" => $this->successStatus, "data"=> $transaction, "message" => "Transaction Successfully"])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
      
            }
             
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
        
    }
}
