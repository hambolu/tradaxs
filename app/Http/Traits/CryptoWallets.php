<?php 

namespace App\Http\Traits;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Auth;
use DB;
use Exception;



trait CryptoWallets
{
    public function myWallet(){
        try
        {
            $btc = Wallet::where('coin_type','btc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btc->coin_type;
               $walletId = $btc->uid;
               $address = $btc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btc_balance = 0;
            }
            
            $eth = Wallet::where('coin_type','eth')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','eth')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $eth->coin_type;
               $walletId = $eth->uid;
               $address = $eth->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $eth_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $eth_balance = 0;
            }
            
            $bch = Wallet::where('coin_type','bch')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bch')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bch->coin_type;
               $walletId = $bch->uid;
               $address = $bch->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bch_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $bch_balance = 0;
            }
            
            $bsv = Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bsv->coin_type;
               $walletId = $bsv->uid;
               $address = $bsv->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bsv_balance = $r['balance'];
                
               //dd($bsv_balance);
            }else{
                $bsv_balance = 0;
            }
            
            $btg = Wallet::where('coin_type','btg')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btg')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btg->coin_type;
               $walletId = $btg->uid;
               $address = $btg->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btg_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btg_balance = 0;
            }
            
            $ltc = Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $ltc->coin_type;
               $walletId = $ltc->uid;
               $address = $ltc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $ltc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $ltc_balance = 0;
            }
    
            $wall = Transaction::where('user_id',Auth::id())->get();
             $coin    = Transaction::select()
                            ->where('user_id',Auth::user()->id)
                            ->where('currency_symbol','btc')
                            ->where('a_status',2)
                            ->sum('amount');
             $w = Wallet::where('user_id',Auth::id())->get();
             
            if (Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->exists()) {
            $hed = [
                  'Content-Type' => 'application/json',
                  ];
            $wallet = Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->first();
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnb-balance',[
                'balance' => $wallet->address
                ]);
            $dd = $response->json();
             $balance = $dd / 10**18;
            }else{
             $balance = 0;
            }
            
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
            //dd($r);
           $usdt = $r['result'] / 10**18;
           $up = Wallet::find($wallet->id);
            $up->balance = $usdt;
            $up->save();
        }else{
            $usdt = 0;
        }
        
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
            //dd($r);
           $btcb_balance = $r['result'] / 10**18;
           $up = Wallet::find($wallet->id);
            $up->balance = $btcb_balance;
            $up->save();
        }else{
            $btcb_balance = 0;
        }
        $usdt_balance = $usdt;
            
            $m = Wallet::where('user_id',Auth::id())->get();
            $wl = Wallet::where('user_id',Auth::id())->pluck('coin_type');
            $numberofwallet = Wallet::where('user_id',Auth::id())->count();
            $total_balance = Wallet::select('balance')->where('user_id', Auth::id())->sum('balance');
           
            return view('wallets.wallet',compact('btcb_balance','total_balance','wall','m','coin','wl','w','balance','numberofwallet','btc_balance','eth_balance','bch_balance','bsv_balance','btg_balance','ltc_balance', 'usdt_balance'));
        }catch(Exception $e){
                return $e;
        }
    }
    public function p2pWallet(){
        try
        {
            $btc = Wallet::where('coin_type','btc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btc->coin_type;
               $walletId = $btc->uid;
               $address = $btc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btc_balance = 0;
            }
            
            $eth = Wallet::where('coin_type','eth')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','eth')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $eth->coin_type;
               $walletId = $eth->uid;
               $address = $eth->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $eth_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $eth_balance = 0;
            }
            
            $bch = Wallet::where('coin_type','bch')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bch')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bch->coin_type;
               $walletId = $bch->uid;
               $address = $bch->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bch_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $bch_balance = 0;
            }
            
            $bsv = Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bsv->coin_type;
               $walletId = $bsv->uid;
               $address = $bsv->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bsv_balance = $r['balance'];
                
               //dd($bsv_balance);
            }else{
                $bsv_balance = 0;
            }
            
            $btg = Wallet::where('coin_type','btg')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btg')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btg->coin_type;
               $walletId = $btg->uid;
               $address = $btg->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btg_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btg_balance = 0;
            }
            
            $ltc = Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $ltc->coin_type;
               $walletId = $ltc->uid;
               $address = $ltc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $ltc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $ltc_balance = 0;
            }
    
            $wall = Transaction::where('user_id',Auth::id())->get();
             $coin    = Transaction::select()
                            ->where('user_id',Auth::user()->id)
                            ->where('currency_symbol','btc')
                            ->where('a_status',2)
                            ->sum('amount');
             $w = Wallet::where('user_id',Auth::id())->get();
             
            if (Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->exists()) {
            $hed = [
                  'Content-Type' => 'application/json',
                  ];
            $wallet = Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->first();
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnb-balance',[
                'balance' => $wallet->address
                ]);
            $dd = $response->json();
             $balance = $dd / 10**18;
            }else{
             $balance = 0;
            }
            
           
            
            $m = Wallet::where('user_id',Auth::id())->get();
            $wl = Wallet::where('user_id',Auth::id())->pluck('coin_type');
            
             //$wallet = Wallet::where('user_id',Auth::id())->get();
             
             $totaltransaction = Transaction::where('m_id',Auth::id())->count();
             $orders = Transaction::where('m_id',Auth::id())->where('m_status',null)->count();
             $numberofwallet = Wallet::where('user_id',Auth::id())->count();
             $inflow = Transaction::where('m_id',Auth::id())->where('m_status',1)->sum('price');
             //dd($inflow);
             $transaction = Transaction::where('m_id',Auth::id())->get();
             //dd($inflow, Auth::id());
           
            return view('merchants.p2p',compact('numberofwallet','totaltransaction','inflow','orders','wall','m','coin','wl','w','balance','btc_balance','eth_balance','bch_balance','bsv_balance','btg_balance','ltc_balance'));
        }catch(Exception $e){
                return $e;
        }
    }
    
    public function makeOrder($id){
        try
        {
            $btc = Wallet::where('coin_type','btc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btc->coin_type;
               $walletId = $btc->uid;
               $address = $btc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btc_balance = 0;
            }
            
            $eth = Wallet::where('coin_type','eth')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','eth')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $eth->coin_type;
               $walletId = $eth->uid;
               $address = $eth->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $eth_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $eth_balance = 0;
            }
            
            $bch = Wallet::where('coin_type','bch')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bch')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bch->coin_type;
               $walletId = $bch->uid;
               $address = $bch->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bch_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $bch_balance = 0;
            }
            
            $bsv = Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bsv->coin_type;
               $walletId = $bsv->uid;
               $address = $bsv->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bsv_balance = $r['balance'];
                
               //dd($bsv_balance);
            }else{
                $bsv_balance = 0;
            }
            
            $btg = Wallet::where('coin_type','btg')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btg')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btg->coin_type;
               $walletId = $btg->uid;
               $address = $btg->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btg_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btg_balance = 0;
            }
            
            $ltc = Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $ltc->coin_type;
               $walletId = $ltc->uid;
               $address = $ltc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $ltc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $ltc_balance = 0;
            }
    
            $wall = Transaction::where('user_id',Auth::id())->get();
             $coin    = Transaction::select()
                            ->where('user_id',Auth::user()->id)
                            ->where('currency_symbol','btc')
                            ->where('a_status',2)
                            ->sum('amount');
             $w = Wallet::where('user_id',Auth::id())->get();
             
            if (Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->exists()) {
            $hed = [
                  'Content-Type' => 'application/json',
                  ];
            $wallet = Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->first();
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnb-balance',[
                'balance' => $wallet->address
                ]);
            $dd = $response->json();
             $balance = $dd / 10**18;
            }else{
             $balance = 0;
            }
            
           
            
            $m = Wallet::where('user_id',Auth::id())->get();
            $wl = Wallet::where('user_id',Auth::id())->pluck('coin_type');
            
             //$wallet = Wallet::where('user_id',Auth::id())->get();
             
             $totaltransaction = Transaction::where('m_id',Auth::id())->count();
             $orders = Transaction::where('m_id',Auth::id())->where('m_status',null)->count();
             $numberofwallet = Wallet::where('user_id',Auth::id())->count();
             $inflow = Transaction::where('m_id',Auth::id())->where('m_status',1)->sum('price');
             //dd($inflow);
             $transaction = Transaction::where('m_id',Auth::id())->get();
             $merchant = Merchant::find($id);
           
            return view('transaction.show',compact('merchant','numberofwallet','totaltransaction','transaction','inflow','orders','wall','m','coin','wl','w','balance','btc_balance','eth_balance','bch_balance','bsv_balance','btg_balance','ltc_balance'));
        }catch(Exception $e){
                return $e;
        }
    }
    public function mytorders(){
        try
        {
            $btc = Wallet::where('coin_type','btc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btc->coin_type;
               $walletId = $btc->uid;
               $address = $btc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btc_balance = 0;
            }
            
            $eth = Wallet::where('coin_type','eth')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','eth')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $eth->coin_type;
               $walletId = $eth->uid;
               $address = $eth->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $eth_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $eth_balance = 0;
            }
            
            $bch = Wallet::where('coin_type','bch')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bch')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bch->coin_type;
               $walletId = $bch->uid;
               $address = $bch->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bch_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $bch_balance = 0;
            }
            
            $bsv = Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bsv->coin_type;
               $walletId = $bsv->uid;
               $address = $bsv->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bsv_balance = $r['balance'];
                
               //dd($bsv_balance);
            }else{
                $bsv_balance = 0;
            }
            
            $btg = Wallet::where('coin_type','btg')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btg')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btg->coin_type;
               $walletId = $btg->uid;
               $address = $btg->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btg_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btg_balance = 0;
            }
            
            $ltc = Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $ltc->coin_type;
               $walletId = $ltc->uid;
               $address = $ltc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $ltc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $ltc_balance = 0;
            }
    
            $wall = Transaction::where('user_id',Auth::id())->get();
             $coin    = Transaction::select()
                            ->where('user_id',Auth::user()->id)
                            ->where('currency_symbol','btc')
                            ->where('a_status',2)
                            ->sum('amount');
             $w = Wallet::where('user_id',Auth::id())->get();
             
            if (Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->exists()) {
            $hed = [
                  'Content-Type' => 'application/json',
                  ];
            $wallet = Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->first();
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnb-balance',[
                'balance' => $wallet->address
                ]);
            $dd = $response->json();
             $balance = $dd / 10**18;
            }else{
             $balance = 0;
            }
            
           $wallet = Wallet::where('coin_type','USDT')->where('user_id',Auth::id())->first();
        
        if (Wallet::where('coin_type','USDT')->where('user_id',Auth::id())->exists()) {
            
            $curl = curl_init();

        
          
              
              $response = Http::get("https://api.bscscan.com/api",[
               "module"=> 'account',
               'action'=>'tokenbalance',
               'contractaddress'=>'0x55d398326f99059fF775485246999027B3197955',
               'address'=> $wallet->address,
               'tag'=>'latest',
               'apikey'=> 'VJJQYZ633Z977IIR6M12AZ1UUYE4MACS6U'
              ]);
          
            
            $r = $response->json();
            
           $usdt_balance = $r['result'] / 10**18;
           $up = Wallet::find($wallet->id);
            $up->balance = $usdt_balance;
            $up->save();
        }else{
             $usdt_balance = 0;
        }
            
            $m = Wallet::where('user_id',Auth::id())->get();
            $wl = Wallet::where('user_id',Auth::id())->pluck('coin_type');
            
             //$wallet = Wallet::where('user_id',Auth::id())->get();
             
             $totaltransaction = Transaction::where('m_id',Auth::id())->count();
             $orders = Transaction::where('m_id',Auth::id())->where('m_status',null)->count();
             
             $numberofwallet = Wallet::where('user_id',Auth::id())->count();
             $inflow = Transaction::where('m_id',Auth::id())->where('m_status',1)->sum('price');
             $transaction = Transaction::where('m_id',Auth::id())->get();
             //dd($inflow, Auth::id());
           
            return view('merchants.MyOrders',compact('numberofwallet','totaltransaction','transaction','inflow','orders','wall','m','coin','wl','w','balance','btc_balance','eth_balance','bch_balance','bsv_balance','btg_balance','ltc_balance','usdt_balance'));
        }catch(Exception $e){
                return $e;
        }
    }
    
    public function mechantsHome(){
        try
        {
            $btc = Wallet::where('coin_type','btc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btc->coin_type;
               $walletId = $btc->uid;
               $address = $btc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btc_balance = 0;
            }
            
            $eth = Wallet::where('coin_type','eth')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','eth')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $eth->coin_type;
               $walletId = $eth->uid;
               $address = $eth->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $eth_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $eth_balance = 0;
            }
            
            $bch = Wallet::where('coin_type','bch')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bch')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bch->coin_type;
               $walletId = $bch->uid;
               $address = $bch->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bch_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $bch_balance = 0;
            }
            
            $bsv = Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','bsv')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $bsv->coin_type;
               $walletId = $bsv->uid;
               $address = $bsv->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $bsv_balance = $r['balance'];
                
               //dd($bsv_balance);
            }else{
                $bsv_balance = 0;
            }
            
            $btg = Wallet::where('coin_type','btg')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','btg')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $btg->coin_type;
               $walletId = $btg->uid;
               $address = $btg->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $btg_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $btg_balance = 0;
            }
            
            $ltc = Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->first();
            
            if (Wallet::where('coin_type','ltc')->where('user_id',Auth::id())->exists()) {
               $fields = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 8151beeb757e872ed6915727886c494e55ea04f626b0028cd8ca5acad78da4cc'
             ];
               $coin = $ltc->coin_type;
               $walletId = $ltc->uid;
               $address = $ltc->address;
               $u1 = 'https://api.cryptx.com/api/v2/';
               $u2 = $coin;
               $u3 = '/wallet/';
               $u4 = $walletId;
               $u5 = $address;
               $url = $u1.$u2.$u3.$u4;
               //dd($url);
               $response = Http::withHeaders($fields)->get($url);
                $r = $response->json('balance');
                
                $ltc_balance = $r['balance'];
                
               //dd($btc_balance);
            }else{
                $ltc_balance = 0;
            }
            
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
            
           $usdt_balance = $r['result'] / 10**18;
           $up = Wallet::find($wallet->id);
            $up->balance = $usdt_balance;
            $up->save();
        }else{
             $usdt_balance = 0;
        }
    
            $wall = Transaction::where('user_id',Auth::id())->get();
             $coin    = Transaction::select()
                            ->where('user_id',Auth::user()->id)
                            ->where('currency_symbol','btc')
                            ->where('a_status',2)
                            ->sum('amount');
             $w = Wallet::where('user_id',Auth::id())->get();
             
            if (Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->exists()) {
            $hed = [
                  'Content-Type' => 'application/json',
                  ];
            $wallet = Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->first();
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnb-balance',[
                'balance' => $wallet->address
                ]);
            $dd = $response->json();
             $balance = $dd / 10**18;
            }else{
             $balance = 0;
            }
            
           
            
            $m = Wallet::where('user_id',Auth::id())->get();
            $wl = Wallet::where('user_id',Auth::id())->pluck('coin_type');
            
             //$wallet = Wallet::where('user_id',Auth::id())->get();
             
             $totaltransaction = Transaction::where('m_id',Auth::id())->count();
             $orders = Transaction::where('m_id',Auth::id())->where('m_status',null)->count();
             $numberofwallet = Wallet::where('user_id',Auth::id())->count();
             $inflow = Transaction::where('m_id',Auth::id())->where('m_status',1)->sum('price');
             //dd($inflow);
             $transaction = Transaction::where('m_id',Auth::id())->get();
             //dd($inflow, Auth::id());
           
            return view('merchants.index',compact('numberofwallet','totaltransaction','inflow','orders','wall','m','coin','wl','w','balance','btc_balance','eth_balance','bch_balance','bsv_balance','btg_balance','ltc_balance','usdt_balance'));
        }catch(Exception $e){
                return $e;
        }
    }
}