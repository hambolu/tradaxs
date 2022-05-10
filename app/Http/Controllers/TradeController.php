<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function buy()
    {
        /* $cryptocurrency = Currency::rates()
        ->latest()
        ->source('crypto')
        ->symbols(['USD'])
        ->get(); */

        $agent = new \Jenssegers\Agent\Agent;
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        if ($desktop) {
            return view('wallet.desktop.buy');
        }
        if ($mobile) {
            return view('wallet.mobile.buy');
        }
    }

    public function details($coin)
    {
        $cryptocurrency = Currency::rates()
        ->fluctuations('2021-11-01', '2021-11-18')
        ->symbols(['USD'])
        ->base($coin)
        ->amount(1)
        ->source('crypto')
        ->get();

        $agent = new \Jenssegers\Agent\Agent;
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        if ($desktop) {
            return view('wallet.desktop.coin-details')->with('cryptocurrency', $cryptocurrency);
        }
        if ($mobile) {
            return view('wallet.mobile.coin-details');
        }
    }
}
