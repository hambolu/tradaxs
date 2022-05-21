<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Merchant;
use App\Models\User;
use App\Http\Traits\CryptoWallets;
use App\Http\Traits\CryptoBalance;
use App\Http\Traits\Accounts;
use App\Models\VirtualAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use DB;
use Exception;



class Merchantp2pController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;
    use CryptoWallets;
    use CryptoBalance;
    use Accounts;



    public function sellP2p()
    {
        $CryptoWallets = $this->p2pWallet();
        return $CryptoWallets;

    }

    public function createOffer(Request $request){
        $tm = $request->input('amountFrom');
        $lm = $request->input('amount_min');
        $user_id = $request->input('userId');
        try{
            if($lm < $tm){
               //dd('error');
               return response()->json(["status" => $this->failedStatus,'error' => 'Total Amount Can not be less than Minimum Order'], 401);
            }else{

            $createoffer = new Merchant();
            $createoffer->offer_type = $request->input('asset');
            $createoffer->price = $request->input('amountFrom');
            $createoffer->currency = $request->input('currency');
            $createoffer->amount_min = $request->input('amount_min');
            $createoffer->amount_max = $request->input('amount_max');
            $createoffer->payment_method = $request->input('payment_method');
            $createoffer->payment_time = $request->input('payment_time');
            $createoffer->m_id = $request->input('userId');
            //dd($createoffer);
            $createoffer->save();

            return response()->json(["status" => $this->successStatus, "data"=> $createoffer])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
            }

        }catch (Exception $e){
            return $e;
        }

    }

    public function buyOffer(Request $request)
    {
        $user_id = $request->input('userId');
        $amount = $request->input('amount');
        $from = $request->input('from');
        $to = $request->input('to');
        try {
            //code...
            $balance = VirtualAccount::where('user_id',$user_id)->first();
            $accountBalance = $balance->accountBalance;

            //dd($accountBalance);
            if($accountBalance >= $amount ){
                $accounts = $this->debitCredit($amount, $from, $to, $user_id);
                $cryptobalance = $this->updateBalance($amount, $from, $to);
                return response()->json(["status" => $this->successStatus, "data"=> [$accounts,$cryptobalance]])
             ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
            }else{
                return response()->json(["status" => $this->failedStatus, "error"=> 'Insufficent Fund'],401);
            }
        } catch (Exception $e){
            return $e;
        }
    }
}
