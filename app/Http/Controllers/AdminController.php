<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Merchant;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Http\Traits\CryptoBalance;

class AdminController extends Controller
{
    //
    public $successStatus = true;
    public $failedStatus = false;
    public function allUsers()
    {
            try{

                $user = User::with('wallets','account')->get();
                return response()->json(["status" => $this->successStatus, "user"=> $user])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
            } catch (Exception $e) {
                return $e;
            }
    }
    public function mOffers()
    {
        try{

            $user = Merchant::with('user')->get();
            return response()->json(["status" => $this->successStatus, "moffers"=> $user])
                ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function trx()
    {
        try{

            $user = Transaction::with('user','users')->get();
            return response()->json(["status" => $this->successStatus, "trx"=> $user])
                ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        } catch (Exception $e) {
            return $e;
        }
    }
}
