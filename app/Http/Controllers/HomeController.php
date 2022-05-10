<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Merchant;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Http\Traits\CryptoWallets;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    use CryptoWallets;
    public function __construct()
    {
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }
    
    public function index(Request $request)
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
        //$mn = $m->name;
        //dd($m);
        $user_balance = Transaction::select('price')
                        ->where('a_status',2)
                        ->where('user_id',Auth::user()->id)
                        ->sum('price');
        
        $t_balance = Transaction::select('price')
                        ->where('m_id',Auth::user()->id)
                        ->where('a_status',2)
                        ->sum('price');
        $t_fees    = Transaction::select('fees')
                        ->where('m_id',Auth::user()->id)
                        ->where('a_status',2)
                        ->sum('fees');
        $coin    = Transaction::select()
                        ->where('user_id',Auth::user()->id)
                        ->where('currency_symbol','btc')
                        ->where('a_status',2)
                        ->sum('amount');
        
        //dd($coin);
        $n_balance = $t_balance - $t_fees;
        
        $balance = User::find(Auth::user()->id);
        $balance->m_balance = $n_balance;
        $balance->save();

        $u_balance = User::find(Auth::user()->id);
        $u_balance->balance = $user_balance;
        $u_balance->save();
        
        $all = User::all();
        $me = Merchant::all();
        $wallets = Wallet::all();
        
         $inflow = Transaction::sum('fees');
        

        if(Auth::user()->role == 1){
            //dd($inflow);
            return view('admin.index', compact('m','all','wallets','inflow','me'));
        }else{
            return view('home.index', compact('m','coin'));
        }
    }


    public function admin()
    {
        
        if(Auth::user()->role == 1){

            return view('admin.index');
        }else{
            return view('home.index');
        }
    }
    
    public function mytransactions(){
        
        $transaction = Transaction::where('user_id',Auth::id())->get();
        return view('home.mytransactions',compact('transaction'));
    }
    
    public function myorders(){
        
        $CryptoWallets = $this->mytorders();
        return $CryptoWallets;
        
        // $transaction = Transaction::where('m_id',Auth::id())->get();
        // return view('merchants.MyOrders',compact('transaction'));
    }
        
     public function p2p()
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
        dd($m);
        // $transac = Transaction::all();
        return view('merchants.index', compact('m'));
    }
    
    
     public function allMerchant()
    {
        $transac = Transaction::all();
        return view('admin.merchants', compact('transac'));
    }
    public function deposit(Request $request)
    {
        $deposit = new Transaction();
        $deposit->price = $request->input('depositAmount');
        $deposit->currency_symbol = $request->input('currency_symbol');
        $deposit->m_status = 1;
        $deposit->user_id = Auth::user()->id;
        //dd($deposit);
        $deposit->save();
        return back()->with('success', 'Funds Deposited.');
    }
    public function buySell(Request $request)
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
        
            $merchants = Merchant::all();
             $coin    = Transaction::select()
                        ->where('user_id',Auth::user()->id)
                        ->where('currency_symbol','btc')
                        ->where('a_status',2)
                        ->sum('amount');
        
            return view('home.buy-sell', compact('merchants','coin','m'));
        
    }
   
    public function merchant(Request $request)
    {
        $merchant = new Merchant();
        $merchant->m_id = Auth::user()->id;
        $merchant->offer_type = $request->input('offer_type');
        $merchant->amount_min = $request->input('amount_min');
        $merchant->amount_max = $request->input('amount_max');
        $merchant->save();
        return back()->with('success', 'Created Successfully.');
    }

    public function merchant_view()
    {
        return view('merchant');
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
        //
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
