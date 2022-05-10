<?php 

namespace App\Http\Traits;

use Exception;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\VirtualAccount;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Arr; 

trait Accounts {
    
          
          
        

    public function createAccount($user_id){
       
            $t = User::where('id',$user_id)->first();
       
        try {
            $response =  Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                "Authorization" => "Bearer sk_live_r11qk3bnede7ub2uxr45",
                ])->post('https://api.collect.africa/reserved_accounts', 
                [
                    "email" => $t->email,
                    "bvn"=> $t->bvn,
                    "account_name" => $t->name,
                    "phone_number" => $t->phone,
                    // "reference" => $ref
                    
                ]);
            // $response =  Http::withHeaders([
            //     'Accept' => 'application/json',
            //     'Content-Type' => 'application/json',
            //     "Authorization" => "Bearer sk_live_27oo5sbf97qvd7bqwf8q",
            //     ])->get('https://api.collect.africa/reserved_accounts/1333');
              $accontres = $response->json();
            //dd($accontres);
            $createaccount = new VirtualAccount();
            $createaccount->accountId = $accontres['data']["id"];
            $createaccount->accountType = $accontres['data']["type"];
            $createaccount->accountStatus = $accontres['data']["status"];
            $createaccount->accountNumber = $accontres['data']["account_number"];
            $createaccount->accountRef = $accontres['data']["reference"];
            $createaccount->bankCode = $accontres['data']["bank_code"];
            $createaccount->bankName = $accontres['data']["bank_name"];
            $createaccount->currency = $accontres['data']["currency"];
            $createaccount->country = $accontres['data']["country"];
            $createaccount->user_id = $user_id;
            $createaccount->save();
            //dd($createaccount);


        }catch(Exception $e){
            return $e;
        }
    }

    public function initializePay($email, $amount, $name, $phone, $user_id){
        $random = Str::random(10);
        $date = Carbon::now();
        $d = $date->toArray();
        $ref = "TRX_Ref_".str_pad($d['timestamp'], 9, "0", STR_PAD_LEFT);

        try {
            $int = (int)$amount;
            $response =  Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                "Authorization" => "Bearer sk_live_r11qk3bnede7ub2uxr45",
                ])->post('https://api.collect.africa/payments/initialize', 
                [
                    "email" => $email,
                    "amount" => $int,
                    "reference" => $ref,
                    "first_name" => $name,
                    "phone_number" => $phone,
                    "callback_url" => "http://localhost:8000/dashboard"
                    // "reference" => $ref
                    
                ]);
                $createTransfer = $response->json();
                
                $ck = $createTransfer['data']['checkout_url'];
                
                $transfer = new Transaction();
                $transfer->trx_ref = $createTransfer['data']['reference'];
                $transfer->user_id = $user_id;
                $transfer->save();
                
                //dd($ck);
                return Redirect::to($ck);
                //code...
        } catch (Exception $e) {
            //throw $e;
            return $e;
        }
    }
    public function getPayment($from, $to){
        $t = VirtualAccount::where('user_id',Auth::id())->first();
        try{
            $response =  Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                "Authorization" => "Bearer sk_live_r11qk3bnede7ub2uxr45",
                ])->get('https://api.collect.africa/payments?',[
                    "perPage"=> "50",
                    "page"=>"1",
                    "reserved_account_id" => $t->accountId
                ]);
            $getpayment = $response->json('data');
            //dd($getpayment);
            foreach ($getpayment as $deals) {
                if(Transaction::where('trx_ref', '=',$deals['reference'])->exists()){
                }else{

                    $transaction = new Transaction();
                    $transaction->trx_ref = $deals['reference'];
                    $transaction->credit = $deals['amount']/100;
                    $transaction->status = $deals['status'];
                    $transaction->paid_at = $deals['paid_at'];
                    $transaction->pass_fee = $deals['fee'];
                    $transaction->channel = $deals['channel'];
                    $transaction->user_id = Auth::id();
                    $transaction->save();

                    return "done";
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }
}