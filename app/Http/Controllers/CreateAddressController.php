<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Auth;
use Session;

class CreateAddressController extends Controller
{
    public function index()
    {
        return view('createaddress');
    }

    //create bitcoin
    public function btc(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/btc/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'BTC';
            $w->coin_name = 'Bitcoin';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

        //create Ethereum
        public function eth(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/eth/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'ETH';
            $w->coin_name = 'Ethereum';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }
    
    //create ripple
    public function xrp(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/xrp/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'XRP';
            $w->coin_name = 'Ripple';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create bitcoin cash
    public function bch(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/bch/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'BCH';
            $w->coin_name = 'Bitcoin Cash';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create litecoin
    public function ltc(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/ltc/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'LTC';
            $w->coin_name = 'Litecoin';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create stellar
    public function xlm(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/xlm/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'XLM';
            $w->coin_name = 'Stellar';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }
    
    //create Eos
    public function eos(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/eos/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'EOS';
            $w->coin_name = 'Eos';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create Tron
    public function trx(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/trx/wallet/61c55a681a114b0008c79c7c6c7d9992/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x26fa3825f4b74f105d4492f5e63068a19709ef4c7ca1e9dcb0507a5ba7b41581',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        dd($s);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'TRX';
            $w->coin_name = 'Tron';
            $w->user_id = Auth::user()->id;
            $w->save();

            Session::flash('message', "Tron Address Created Successfully");
            return Redirect::back();
    }

    //create Ethereum Classic
    public function etc(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/etc/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'ETC';
            $w->coin_name = 'Ethereum Classic';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create Dash
    public function dash(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/dash/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'DASH';
            $w->coin_name = 'Dash';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create ZCash
    public function zec(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/zec/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'ZEC';
            $w->coin_name = 'ZCash';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

        //create Algorand
        public function algo(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/algo/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'ALGO';
            $w->coin_name = 'Algorand';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }
    
    //create Mainnet Hedera
    public function hbar(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/hbar/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'HBAR';
            $w->coin_name = 'Mainnet Hedera';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create Celo Gold
    public function celo(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/celo/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'CELO';
            $w->coin_name = 'Celo Gold';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create Bitcoin SV
    public function bsv(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/bsv/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'BSV';
            $w->coin_name = 'Bitcoin SV';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create Bitcoin Gold
    public function btg(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/btg/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'BTG';
            $w->coin_name = 'Bitcoin Gold';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }
    
    //create Avalanche C-Chain
    public function avaxc(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/avaxc/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'AVAXC';
            $w->coin_name = 'Avalanche C-Chain';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create Casper
    public function cspr(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/cspr/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'CSPR';
            $w->coin_name = 'Casper';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create Rootstock RSK
    public function rbtc(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/rbtc/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'RBTC';
            $w->coin_name = 'STX';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }

    //create Stacks
    public function stx(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.bitgo.com/api/v2/stx/wallet/61c26da4f7131a000892a8c9e6c9e3f3/address',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'walletId=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer v2x0b5fa2888ddbb32e5cdb1e21d0dbced801de1e6eada76935534a8cbaf767c486',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);
        // echo $response;
        $w = json_decode($response);
        $s = get_object_vars($w);
        //dd($s['id']);
        $w = new wallet();
            $w->user_name = Auth::user()->name;
            $w->wallet_id = $s['id'];
            $w->address = $s['address'];
            $w->coin_type = 'STX';
            $w->coin_name = 'Stacks';
            $w->user_id = Auth::user()->id;
            $w->save();

        return back()->with('success', 'Wallet Created Successfully.');
    }
}
