<?php

namespace App\Http\Controllers;

use App\Models\UserCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TwoFAController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()

    {

        $agent = new \Jenssegers\Agent\Agent;
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        if ($desktop) {
            return view('wallet.desktop.sms-verify');
        }
        if ($mobile) {
            return view('wallet.mobile.sms-verify');
        }

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $find = UserCode::where('user_id', auth()->user()->id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();


        if (!is_null($find)) {
            Session::put('user_2fa', Auth::user()->id);
            return redirect()->route('wallet');
        }
        return back()->with('error', 'You entered wrong code.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        auth()->user()->generateCode();
        return back()->with('success', 'We sent you code on your mobile number.');
    }
}
