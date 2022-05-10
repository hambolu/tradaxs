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

trait CryptoBalance 
{
    public function balance($user_id)
    {
        try {
            //code...
        
                if (Wallet::where('coin_type','USDT')->where('user_id',$user_id)->exists()) {

                    $wallet = Wallet::where('coin_type','USDT')->where('user_id',$user_id)->first();

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
                    //dd($up);
                    $up->save();
                }
                if (Wallet::where('coin_type','BNB')->where('user_id',$user_id)->exists()) {

                $wallet = Wallet::where('coin_type','BNB')->where('user_id',$user_id)->first();

                $response = Http::get("https://api.bscscan.com/api",[
                "module"=> 'account',
                'action'=>'tokenbalance',
                'contractaddress'=>'0x095418A82BC2439703b69fbE1210824F2247D77c',
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
            }
            if (Wallet::where('coin_type','BTCB')->where('user_id',$user_id)->exists()) {

                $wallet = Wallet::where('coin_type','BTCB')->where('user_id',$user_id)->first();

                $response = Http::get("https://api.bscscan.com/api",[
                "module"=> 'account',
                'action'=>'tokenbalance',
                'contractaddress'=>'0x7130d2a12b9bcbfae4f2634d864a1ee1ce3ead9c',
                'address'=> $wallet->address,
                'tag'=>'latest',
                'apikey'=> 'VJJQYZ633Z977IIR6M12AZ1UUYE4MACS6U'
                ]);
            
            
                $r = $response->json();
                //dd($r);
                $usdt = $r['result'] / 10**18;

                $up = Wallet::find($wallet->id);
                $up->balance = $usdt;
                //dd($up);
                $up->save();
            }

        } catch (Exception $e) {
            return $e;
        }
    }
}