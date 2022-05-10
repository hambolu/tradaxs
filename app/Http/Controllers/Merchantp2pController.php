<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Merchant;
use App\Models\User;
use App\Http\Traits\CryptoWallets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use DB;
use Exception;



class Merchantp2pController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;
    use CryptoWallets;
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
            $createoffer->m_id = $user_id;
            //dd($createoffer);
            $createoffer->save();
            
            return response()->json(["status" => $this->successStatus, "data"=> $createoffer])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
            }
            
        }catch (Exception $e){
            
        }
    }
}