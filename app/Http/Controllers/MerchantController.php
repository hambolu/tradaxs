<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerchantRequest;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\CryptoWallets;






class MerchantController extends Controller
{

    use CryptoWallets;
    
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CryptoWallets = $this->mechantsHome();
        return $CryptoWallets;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->image){
            $agent = new \Jenssegers\Agent\Agent;
            $desktop = $agent->isDesktop();
            $mobile = $agent->isMobile();
            if ($desktop) {
                return view('wallet.desktop.become_merchant');
            }
            if ($mobile) {
                return view('wallet.mobile.become_merchant');
            }
        }else{
            $agent = new \Jenssegers\Agent\Agent;
            $desktop = $agent->isDesktop();
            $mobile = $agent->isMobile();
            if ($desktop) {
                return redirect()->route('profile.index')->with('error', 'update your profile before you can register as a merchant' );
            }
            if ($mobile) {
                return redirect()->route('profile.index')->with('error', 'update your profile before you can register as a merchant' );
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerchantRequest $request)
    {
        $user = Auth::user();
        $bank = Merchant::create([
            'email' => Auth::user()->email,
            'account_name' => $request->account_name,
            'bank' => $request->bank_name,
            'account_number' => $request->account_number,
            'bvn' => $request->bank_verification_number,
            'nin' => $request->national_identity_number,
        ]);
        $user->bank()->attach($bank);
        $user->roles()->attach(3);

        return redirect()->route('profile.index')->with('message', 'Merchant Created Successfully');
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
