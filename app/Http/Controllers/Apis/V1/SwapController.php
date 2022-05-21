<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;

class SwapController extends Controller
{
    //
    public $successStatus = true;
    public $failedStatus = false;

    public function Swap(Request $request)
    {
        $user_id = $request->input('userId');
        $fromTokenAddress = $request->input('fromTokenAddress');
        $toTokenAddress = $request->input('toTokenAddress');
        $amount = $request->input('amount');
        $value = $amount * "10" ** "18";
        $fromAddress = $request->input('fromAddress');
        //$pkey = $request->input('pkey');
        $pkey = '0x64fbb600522d5632db0683f961ac6bae3ced151557e8b3767bdc78f900262f9c';
        try {
            //dd($value);
            //code...

            $hed = [
                'Content-Type' => 'application/json',
                ];
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('http://localhost:8080/swapTransaction',[
                'fromTokenAddress' => $fromTokenAddress,
                'toTokenAddress' => $toTokenAddress,
                'amount' => $amount,
                'pkey' => $pkey,
                'fromAddress' => $fromAddress,
                ]);
                $swapTransaction = $response->json();

            // $response = Http::get('https://api.1inch.io/v4.0/56/swap?',[
            //     'fromTokenAddress' => $fromTokenAddress,
            //     'toTokenAddress' => $toTokenAddress,
            //     'amount' => $value,
            //     'fromAddress' => $fromAddress,
            //     'slippage' => 1,
            //     'disableEstimate' => "true"
            // ]);
            // $swap = $response->json();
            // $transaction = $swap['tx']['data'];


            return response()->json(["status" => $this->successStatus, "data"=> [$swapTransaction]])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        } catch (Exception $e) {
            return $e;
        }
    }
}
