<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Settings;
use App\Http\Traits\CryptoWallets;
use Auth;
use Illuminate\Support\Facades\Http;
use WisdomDiala\Cryptocap\Facades\Cryptocap;


class TransactionsController extends Controller
{
    
    use CryptoWallets;
    
    public function index()
    {
        $t_balance = Transaction::select('price')
                        ->where('m_id',Auth::user()->id)
                        ->sum('price');
        $t_fees    = Transaction::select('fees')
                        ->where('m_id',Auth::user()->id)
                        ->sum('fees');
        $balance = $t_balance - $t_fees;
        $transac = Transaction::where('m_id',Auth::user()->id)->get();
        //dd($transac);
        return view('transaction.index',compact('transac','balance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $CryptoWallets = $this->makeOrder($id);
        return $CryptoWallets;
        
    }
    public function confirm(Request $request, $id)
    {
        try{
            //merchant confirmation
            // $transac = Transaction::find($id);
            
            // $transac->m_status = 1;
            // $transac->save();  
            $send = Transaction::find($id);
            if($send->currency_symbol == 'bnb'){
                
            $wallet = Wallet::where('coin_type','bnb')->where('user_id',Auth::id())->first();
            $holder = Wallet::where('user_id',Auth::id())->where('coin_type',$send->currency_symbol)->first();
            
            $rates = Cryptocap::getSingleAsset('binance-coin');
            $t =  $send->amount / $rates->data->priceUsd ;
            //dd(round($t,6));
            //dd($holder->address);
            
            $hed = [
              'Content-Type' => 'application/json',
              ];
        
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnbtx',[
                'holder' => $send->currency,
                'pkey' => $wallet->uid,
                'amount' => round($t,6),
                'gprice' => "20000000000",
                'gas' => "21000",
                ]);
            $tx = $response->json();
            
            //Transaction Fee   0xf07a604f13d9447846ab06da3541165baaecb738
            $response = Http::withHeaders($hed)->bodyFormat('json')->post('https://tradaxs-api.herokuapp.com/bnbtx',[
                'holder' => '0x753A5aFE4bD69fbf7F465F5e7Fae25B4080AC2Ca',  
                'pkey' => $wallet->uid,
                'amount' => round($t,6),
                'gprice' => "20000000000",
                'gas' => "21000",
                ]);
            $txfee = $response->json();
            
            dd($tx, $txfee);
            
            $st = $response->status();
            if($st == 404){
                return back()->with('error', 'Insufficent Fund.');
            }else{
                
                $transac = Transaction::find($id);
                $transac->m_status = 1;
                $transac->save();  
            }
            return back()->with('success', 'Transaction Confirmed');
            }
            
        }catch(Exception $e){
            
        }

    }

    public function approve(Request $request, $id)
    {
        //merchant confirmation
        $transac = Transaction::find($id);
        $transac->a_status = 2;
        $transac->save();  

        // $order = new Wallet();
        // $order->amount = $request->input('amount');
        // $price = $order->amount * $order->currency;
        // $order->price = round($price) ;
        // $order->currency_symbol = $request->input('currency_symbol');
        // $order->user_id = Auth::user()->id;
        // $fees = (0.5 / 100) * $price;
        // $order->fees = round($fees,2);
        // //dd($order);
        // $order->save();
        return back()->with('success', 'Confirmed');
    }
    public function order(Request $request)
    {
        
        $rate = Settings::where('id',1)->first();
        // dd($rate->convertingRate);
        
        $order = new Transaction();
        $order->m_id = $request->input('m_id');
        $order->amount = $request->input('amount');
        $order->currency = $request->input('currency');
        $price = $order->amount * $rate->convertingRate;
        $order->price = $price ;
        $order->currency_symbol = $request->input('currency_symbol');
        $order->user_id = Auth::user()->id;
        $order->fees = $rate->convertingRate;
        //dd($order);
        $order->save();
        
        

        return back()->with('success', 'Created Successfully.');
    }
    
    public function receive(Request $request)
    {
        

        $recive = new Transaction();
        $recive->amount = $request->input('amount');
        $recive->receive_from = $request->input('from');
        $recive->currency = $request->input('currency');
        $recive->user_id = Auth::user()->id;
       
        //dd($recive);
        $recive->save();
        
        

        return back()->with('success', 'Created Successfully.');
    }
    
     public function sendTo(Request $request)
    {
        

        try{
            
        }catch(Exception $e){
            
        }
        
        

        return back()->with('success', 'Created Successfully.');
    }
     public function swap(Request $request)
    {
        if($request->input('swapamount') >= Auth::user()->balance)
        {
            return back()->with('error', 'Insufficient Balance');
        }else{
        $recive = new Transaction();
        $recive->swapamount = $request->input('swapamount');
        $recive->swapfrom = $request->input('swapfrom');
        $recive->swapto = $request->input('swapto');
        $recive->user_id = Auth::user()->id;
       
        //dd($recive);
        $recive->save();
        

        return back()->with('success', 'Created Successfully.');
        }
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
