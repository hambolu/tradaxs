<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\User;
use DB;
// use Web3\Web3;
// use Web3\Eth;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
//use RenokiCo\LaravelWeb3\Web3Facade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use RenokiCo\LaravelWeb3\Web3Facade as Web3;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Exception;
use App\Http\Traits\CryptoWallets;
use WisdomDiala\Cryptocap\Facades\Cryptocap;
use Illuminate\Http\Client\Pool;



class WalletController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CryptoWallets;
    public function index()
    {
        
        // $rates = Cryptocap::getSingleAsset('binance-coin');
        // dd($rates);
         $CryptoWallets = $this->myWallet();
        
         return $CryptoWallets;
       
    }
   
    public function balance(){

     $id = User::where('id',Auth::id())->get();                 
        $wallet = Wallet::where('coin_type','eth')
                    ->where('user_id',Auth::id())->get();

        $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
           $coin = $wallet->coin_type;
           $walletId = $wallet->uid;
           $address = $wallet->address;
           $u1 = 'https://api.cryptx.com/api/v2/';
           $u2 = $coin;
           $u3 = '/wallet/';
           $u4 = $walletId;
           $u5 = $address;
           $url = $u1.$u2.$u3.$u4;
           //dd($url);
           $response = Http::withHeaders($fields)->get($url);
            $r = $response->json('balance');
            $balance = $r['balance'];
            dd($r,$balance);
    }
    
    public function cBtc(Request $request)
    {
         $wallet = Wallet::where('coin_type','btc')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','btc')->where('user_id',Auth::id())->exists()) {
           $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
           $coin = $wallet->coin_type;
           $walletId = $wallet->uid;
           $address = $wallet->address;
           $u1 = 'https://api.cryptx.com/api/v2/';
           $u2 = $coin;
           $u3 = '/wallet/';
           $u4 = $walletId;
           $u5 = $address;
           $url = $u1.$u2.$u3.$u4;
           //dd($url);
           $response = Http::withHeaders($fields)->get($url);
            $r = $response->json('balance');
            
            $balance = $r['balance'];
            
            //dd($r,$balance);
            return response()->json(["status" => $this->successStatus, "balance"=> $balance, wa])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
           return view('wallets.view', compact('wallet','balance'));
        }else{
        $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
        $response = Http::withHeaders($fields)->post('https://api.cryptx.com/api/v2/commons/btc/wallet/create',[
            'name'=> Str::random(20)
            ]);
        $r = $response->json();
        //dd($r);
        $w = new wallet();
        $w->coin_type = $r['coin'];
        $w->uid = $r['uid'];
        $w->wallet_name = $r['name'];
        $w->balance = $r['balance']['balance'];
        $w->frozen = $r['frozen'];
        $w->address = $r['defaultAddress'];
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        $balance = 0;
        $wallet = Wallet::where('coin_type','btc')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    public function cEth(Request $request)
    {
         $wallet = Wallet::where('coin_type','eth')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','eth')->where('user_id',Auth::id())->exists()) {
           $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
           $coin = $wallet->coin_type;
           $walletId = $wallet->uid;
           $address = $wallet->address;
           $u1 = 'https://api.cryptx.com/api/v2/';
           $u2 = $coin;
           $u3 = '/wallet/';
           $u4 = $walletId;
           $u5 = $address;
           $url = $u1.$u2.$u3.$u4;
           //dd($url);
           $response = Http::withHeaders($fields)->get($url);
            $r = $response->json('balance');
            $balance = $r['balance'];
            //dd($r,$balance);
           return view('wallets.view', compact('wallet','balance'));
        }else{
        $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
        $response = Http::withHeaders($fields)->post('https://api.cryptx.com/api/v2/commons/eth/wallet/create',[
            'name'=> Str::random(20),
            'walletType'=> 'SINGLE_ADDRESS'
            ]);
        $r = $response->json();
        //dd($r);
        $w = new wallet();
        $w->coin_type = $r['coin'];
        $w->uid = $r['uid'];
        $w->wallet_name = $r['name'];
        $w->balance = $r['balance']['balance'];
        $w->frozen = $r['frozen'];
        $w->address = $r['defaultAddress'];
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        $balance = 0;
        $wallet = Wallet::where('coin_type','eth')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    public function cBch(Request $request)
    {
         $wallet = Wallet::where('coin_type','bch')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','bch')->where('user_id',Auth::id())->exists()) {
           $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
           $coin = $wallet->coin_type;
           $walletId = $wallet->uid;
           $address = $wallet->address;
           $u1 = 'https://api.cryptx.com/api/v2/';
           $u2 = $coin;
           $u3 = '/wallet/';
           $u4 = $walletId;
           $u5 = $address;
           $url = $u1.$u2.$u3.$u4;
           //dd($url);
           $response = Http::withHeaders($fields)->get($url);
            $r = $response->json('balance');
            $balance = $r['balance'];
            //dd($r,$balance);
           return view('wallets.view', compact('wallet','balance'));
        }else{
        $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
        $response = Http::withHeaders($fields)->post('https://api.cryptx.com/api/v2/commons/bch/wallet/create',[
            'name'=> Str::random(20)
            ]);
        $r = $response->json();
        //dd($r);
        $w = new wallet();
        $w->coin_type = $r['coin'];
        $w->uid = $r['uid'];
        $w->wallet_name = $r['name'];
        $w->balance = $r['balance']['balance'];
        $w->frozen = $r['frozen'];
        $w->address = $r['defaultAddress'];
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
                $balance = 0;
        $wallet = Wallet::where('coin_type','bch')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    public function cBsv(Request $request)
    {
         $wallet = Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->exists()) {
           $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
           $coin = $wallet->coin_type;
           $walletId = $wallet->uid;
           $address = $wallet->address;
           $u1 = 'https://api.cryptx.com/api/v2/';
           $u2 = $coin;
           $u3 = '/wallet/';
           $u4 = $walletId;
           $u5 = $address;
           $url = $u1.$u2.$u3.$u4;
           //dd($url);
           $response = Http::withHeaders($fields)->get($url);
            $r = $response->json('balance');
            $balance = $r['balance'];
            //dd($r,$balance);
           return view('wallets.view', compact('wallet','balance'));
        }else{
        $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
        $response = Http::withHeaders($fields)->post('https://api.cryptx.com/api/v2/commons/bsv/wallet/create',[
            'name'=> Str::random(20)
            ]);
        $r = $response->json();
        //dd($r);
        $w = new wallet();
        $w->coin_type = $r['coin'];
        $w->uid = $r['uid'];
        $w->wallet_name = $r['name'];
        $w->balance = $r['balance']['balance'];
        $w->frozen = $r['frozen'];
        $w->address = $r['defaultAddress'];
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        $balance = 0;
        $wallet = Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    public function cBtg(Request $request)
    {
         $wallet = Wallet::where('coin_type','btg')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','btg')->where('user_id',Auth::id())->exists()) {
           $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
           $coin = $wallet->coin_type;
           $walletId = $wallet->uid;
           $address = $wallet->address;
           $u1 = 'https://api.cryptx.com/api/v2/';
           $u2 = $coin;
           $u3 = '/wallet/';
           $u4 = $walletId;
           $u5 = $address;
           $url = $u1.$u2.$u3.$u4;
           //dd($url);
           $response = Http::withHeaders($fields)->get($url);
            $r = $response->json('balance');
            $balance = $r['balance'];
            //dd($r,$balance);
           return view('wallets.view', compact('wallet','balance'));
        }else{
        $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
        $response = Http::withHeaders($fields)->post('https://api.cryptx.com/api/v2/commons/btg/wallet/create',[
            'name'=> Str::random(20)
            ]);
        $r = $response->json();
        //dd($r);
        $w = new wallet();
        $w->coin_type = $r['coin'];
        $w->uid = $r['uid'];
        $w->wallet_name = $r['name'];
        $w->balance = $r['balance']['balance'];
        $w->frozen = $r['frozen'];
        $w->address = $r['defaultAddress'];
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        $balance = 0;
        $wallet = Wallet::where('coin_type','btg')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    public function cLtc(Request $request)
    {
         $wallet = Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->exists()) {
           $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
           $coin = $wallet->coin_type;
           $walletId = $wallet->uid;
           $address = $wallet->address;
           $u1 = 'https://api.cryptx.com/api/v2/';
           $u2 = $coin;
           $u3 = '/wallet/';
           $u4 = $walletId;
           $u5 = $address;
           $url = $u1.$u2.$u3.$u4;
           //dd($url);
           $response = Http::withHeaders($fields)->get($url);
            $r = $response->json('balance');
            $balance = $r['balance'];
            //dd($r,$balance);
           return view('wallets.view', compact('wallet','balance','price'));
        }else{
        $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
        $response = Http::withHeaders($fields)->post('https://api.cryptx.com/api/v2/commons/ltc/wallet/create',[
            'name'=> Str::random(20)
            ]);
        $r = $response->json();
        //dd($r);
        $w = new wallet();
        $w->coin_type = $r['coin'];
        $w->uid = $r['uid'];
        $w->wallet_name = $r['name'];
        $w->balance = $r['balance']['balance'];
        $w->frozen = $r['frozen'];
        $w->address = $r['defaultAddress'];
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        $balance = 0;
        $wallet = Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    //under maintaince
    public function cUsdt(Request $request)
    {
         $wallet = Wallet::where('coin_type','USDT')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','USDT')->where('user_id',Auth::id())->exists()) {

              $response = Http::get("https://api.bscscan.com/api",[
               "module"=> 'account',
               'action'=>'tokenbalance',
               'contractaddress'=>'0x55d398326f99059fF775485246999027B3197955',
               'address'=> $wallet->address,
               'tag'=>'latest',
               'apikey'=> 'VJJQYZ633Z977IIR6M12AZ1UUYE4MACS6U'
              ]);
          
            
            $r = $response->json();
            
           $balance = $r['result'] / 10**18;
           $up = Wallet::find($wallet->id);
            $up->balance = $balance;
            $up->save();
            //dd($balance);
           return view('wallets.view', compact('wallet','balance'));
        }else{
        $wallet = Wallet::where('coin_type','BNB')->where('user_id',Auth::id())->first();
        $w = new wallet();
        $w->coin_type = "USDT";
        $w->uid = $wallet->uid;
        $w->wallet_name = 'USDT';
        $w->balance = "0";
        $w->address = $wallet->address;
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        $balance = 0;
        $wallet = Wallet::where('coin_type','usdt')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    public function cBTCB(Request $request)
    {
         $wallet = Wallet::where('coin_type','BTCB')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','BTCB')->where('user_id',Auth::id())->exists()) {

              $response = Http::get("https://api.bscscan.com/api",[
               "module"=> 'account',
               'action'=>'tokenbalance',
               'contractaddress'=>'0x7130d2A12B9BCbFAe4f2634d864A1Ee1Ce3Ead9c',
               'address'=> $wallet->address,
               'tag'=>'latest',
               'apikey'=> 'VJJQYZ633Z977IIR6M12AZ1UUYE4MACS6U'
              ]);
          
            
            $r = $response->json();
            
           $balance = $r['result'] / 10**18;
           $up = Wallet::find($wallet->id);
            $up->balance = $balance;
            $up->save();
            //dd($balance);
           return view('wallets.view', compact('wallet','balance'));
        }else{
        $wallet = Wallet::where('coin_type','BNB')->where('user_id',Auth::id())->first();
        $w = new wallet();
        $w->coin_type = "BTCB";
        $w->uid = $wallet->uid;
        $w->wallet_name = 'BTCB';
        $w->balance = "0";
        $w->address = $wallet->address;
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        $balance = 0;
        $wallet = Wallet::where('coin_type','BTCB')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    public function getCoin()
    {
        //X-CMC_PRO_API_KEY: 822f13f0-7807-4551-9ba4-109153fc9cf7
        $fields = [
        'X-CMC_PRO_API_KEY' => '822f13f0-7807-4551-9ba4-109153fc9cf7'
         ];
        $response = Http::withHeaders($fields)->accept('application/json')->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest');
        $dd = $response->json('data');
        dd($dd);
        
        // $foo = 'https://coincodex.com/apps/coincodex/cache/all_coins.json';
        
        // $pretty=json_decode($foo, JSON_PRETTY_PRINT);
        
        // dd($pretty);

        
    }
    
    
    public function sendUsdt(Request $request){
        
        $wallet = Wallet::where('coin_type','USDT')->where('user_id',Auth::id())->first();
             $hed = [
              'Content-Type' => 'application/json',
              ];
        //$q = 0.2 * 10**18;
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
        if($t < $balance){
            return back()->with('error', 'Insufficent Fund.');
        }elseif($st == 404){
            return back()->with('error', 'Insufficent Fund.');
        }elseif($st == 200){
            
            $transaction = new Transaction();
        $transaction->currency_symbol = $wallet->coin_type;
        $transaction->sentTo = $request->input('address');
        $transaction->amount = $request->input('amount');
        $transaction->user_id = Auth::id();
        $transaction->save();
        
            return back()->with('success', 'Transaction Successfully');
  
        }
    }
    
    
    
    
    
    
    
    public function create()
    {
        //
        //return view('wallets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function sendCoin(Request $request)
    {
        $coin = $request->input('coin_type');
        if($coin != 'bnb'){
       $fields = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
         ];
           $coin = $request->input('coin_type');
           $walletId = $request->input('walletId');
           $address = $request->input('address');
           $amount = $request->input('amount');
           
           //https://api.cryptx.com/api/v2/{coin}/wallet/{walletId}/transaction
           $u1 = 'https://api.cryptx.com/api/v2/';
           $u2 = $coin;
           $u3 = '/wallet/';
           $u4 = $walletId;
           $u5 = '/transaction';
           $url = $u1.$u2.$u3.$u4.$u5;
           //dd($url);
           $response = Http::withHeaders($fields)->post($url,[
               'uniqueId'=> Str::random(40),
               'address' => $address,
               'value' => (int)$amount
               ]);
            $r = $response->json();
            //$balance = $r['balance'];
            $status = $response->status();
            //dd($r, $status);
            if($status != '200'){
                return back()->with('error', 'Insufficient Funds.');
            }else{
            return back()->with('success', 'Transaction Successfully.');
            }
        }else{
            $address = $request->input('address');
        $amount = $request->input('amount');
        $fees = 0.01 *$amount;
        
        //dd($amount);
        
           
        
        $url = 'https://coinremitter.com/api/v3/BNB/withdraw';
        
        $fields = [
        'api_key' => '$2y$10$aLLEEp4DnLfLwhY.CBROAeJ/Ti2Em9.sA01hTWxVrdWyjGqHk8f9a',
        'password'=> 'Tradaxs@2020',
        'to_address' => $address,
        'amount' => $amount,
        ];
    //dd($fields);
     $response = Http::accept('application/json')->post('https://coinremitter.com/api/v3/BNB/withdraw',$fields);
     $r = $response->json('flag');
    //dd($dd);
    
        $response = Http::accept('application/json')->post('https://coinremitter.com/api/v3/BNB/withdraw',[
        'api_key' => '$2y$10$aLLEEp4DnLfLwhY.CBROAeJ/Ti2Em9.sA01hTWxVrdWyjGqHk8f9a',
        'password'=> 'Tradaxs@2020',
        'to_address' => '0x3ddc2Dd0Deba23C58C723Ba1D900EAA736e212dC',
        'amount' => $fees,
        ]);
        $r = $response->json('flag');
        
        $response = Http::accept('application/json')->post('https://coinremitter.com/api/v3/BNB/withdraw',[
        'api_key' => '$2y$10$aLLEEp4DnLfLwhY.CBROAeJ/Ti2Em9.sA01hTWxVrdWyjGqHk8f9a',
        'password'=> 'Tradaxs@2020',
        'to_address' => '0x3ddc2Dd0Deba23C58C723Ba1D900EAA736e212dC',
        'amount' => $fees,
        ]);
        $r = $response->json('flag');
        //$r= $response->status();
        //dd($r,$r1);
         if($r = 0|2)
        {
            return back()->with('error', 'Insufficient Funds.');
        }elseif($r = 1)
        {
        return back()->with('success', 'Transaction Successfully.');
        }else{
            return back()->with('error', 'Transaction Unsuccessfully.');
        }
        }
    }
    
    public function createBnb()
    {
        $wallet = Wallet::where('coin_type','BNB')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','BNB')->where('user_id',Auth::id())->exists()) {
          $hed = [
              'Content-Type' => 'application/json',
              ];
        
        $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnb-balance',[
            'balance' => $wallet->address
            ]);
        $dd = $response->json();
        
        
        $balance = $dd / 10**18;
        //dd($balance);
        $up = Wallet::find($wallet->id);
        $up->balance = $balance;
        $up->save();
        
        
        
        return view('wallets.view', compact('wallet','balance'));
        }else{
        $fields = [
        'Content-Type' => 'application/json',
         ];
        $response = Http::withHeaders($fields)->get('https://tradaxs-api.herokuapp.com/bnb');
        $r = $response->json();
         
        //dd($r);
        $w = new wallet();
        $w->coin_type = 'BNB';
        $w->address = $r['address'];
        $w->uid = $r['privateKey'];
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        
        $w = new wallet();
        $w->coin_type = 'USDT';
        $w->address = $r['address'];
        $w->uid = $r['privateKey'];
        $w->user_id = Auth::user()->id;
        //dd($w);
        $w->save();
        
        $receive    = Transaction::select()
                        ->where('user_id',Auth::user()->id)
                        ->where('currency_symbol','BNB')
                        ->where('type','receive')
                        ->sum('amount');
        $send    = Transaction::select()
                        ->where('user_id',Auth::user()->id)
                        ->where('currency_symbol','BNB')
                        ->where('type','send')
                        ->sum('amount');
        $balance = 0;
        $balance = $receive - $send;
        $wallet = Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->first();
        return view('wallets.view', compact('wallet','balance'));
        }
    }
    
    public function vwallets(Request $request)
    {
            $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-CMC_PRO_API_KEY: 822f13f0-7807-4551-9ba4-109153fc9cf7'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $market =  json_decode($response);
        $m = $market->data;
        
            $w = Wallet::all();
           return view('admin.wallets',compact('w','m'));
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendBnb(Request $request)
    {
        $wallet = Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->first();
      
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
        
        $balance = $dd / 10**18;
        
        if($t < $balance){
            return back()->with('error', 'Insufficent Fund.');
        }elseif($st == 404){
            return back()->with('error', 'Insufficent Fund.');
        }elseif($st == 200){
            
            $transaction = new Transaction();
        $transaction->currency_symbol = $wallet->coin_type;
        $transaction->sentTo = $request->input('address');
        $transaction->amount = $request->input('amount');
        $transaction->user_id = Auth::id();
        $transaction->save();
        
            return back()->with('success', 'Transaction Successfully');
  
        }
         
    }
    public function updateWallet($id)
    {
         $tr = Wallet::find($id);
        //dd($tr);
         $url1 = 'https://api.cryptx.com/api/v2/';
    $url2 = $tr->coin_type;
    $url4 = $tr->uid;
    $url5 = '/balance';
    $url3 ='/wallet/';
    
    
    $url = $url1.$url2.$url3.$url4.$url5;
    //dd($url);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
         $wallet =  json_decode($response, true);
         //dd($wallet['balance']);
         $wup = Wallet::find($id);
         $wup->balance = $wallet['balance'];
         $wup->save();
    }
    public function show($id)
    {
        
        
       $mecc = Wallet::find($id);
        if($mecc->coin_type == 'bnb')
        {
           
        
        $url = 'https://coinremitter.com/api/v3/BNB/get-transaction-by-address';
        
        $fields = [
        'api_key' => '$2y$10$aLLEEp4DnLfLwhY.CBROAeJ/Ti2Em9.sA01hTWxVrdWyjGqHk8f9a',
        'password'=> 'Tradaxs@2020',
        'address' => $mecc->address

    ];
    $response = Http::accept('application/json')->post('https://coinremitter.com/api/v3/BNB/get-transaction-by-address',[
        'api_key' => '$2y$10$aLLEEp4DnLfLwhY.CBROAeJ/Ti2Em9.sA01hTWxVrdWyjGqHk8f9a',
        'password'=> 'Tradaxs@2020',
        'address' => $mecc->address
        ]);
    $dd = $response->json('data');
    //$d = Arr::dot($dd);
    $bnb = Arr::last($dd);    
    //dd($bnb);
    $tx = Transaction::select('txid')->where('user_id',$mecc->user_id)->where('currency_symbol',$mecc->coin_type)->pluck('txid');
    //dd($tx);
    if(Transaction::where('txid', $bnb['txid'] )->exists())
    {
        //dd($tx);
    }else{
        
        $wup = new Transaction();
         $wup->type = $bnb['type'];
         $wup->amount = $bnb['amount'];
         $wup->txid = $bnb['txid'];
         $wup->currency_symbol = 'bnb';
         $wup->user_id = $mecc->user_id;
         //dd($wup);
         $wup->save();
    }
         
         
        
        }
        
        $receive    = Transaction::select()
                        ->where('user_id',Auth::user()->id)
                        ->where('currency_symbol','bnb')
                        ->where('type','receive')
                        ->sum('amount');
        $send    = Transaction::select()
                        ->where('user_id',Auth::user()->id)
                        ->where('currency_symbol','bnb')
                        ->where('type','send')
                        ->sum('amount');
        $balance = 0;
        $balance = $receive - $send;
        
        return view('wallets.view',compact('mecc','balance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
