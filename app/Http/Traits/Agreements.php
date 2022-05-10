<?php

namespace App\Http\Traits;
use Exception;
use App\Models\Agreement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


trait Agreements
{
    public function work()
    {
        $condition = Agreement::where('condition',1)
                        ->where('user_id', Auth::id())
                        ->first();
        $user = User::where('id', Auth::id())
                        ->first();
        $userInfo = $user->email;
        $date = Carbon::now();
        $d = $date->toArray();
        $timestamp = $d['timestamp'].$d['micro'];
        $token = Str::random(32).$timestamp;

        try {
            if($condition->condition == 1){
                
                $user_info = Hash::make($userInfo);
                $u = Agreement::find($condition->id);
                $u->user_info = $user_info;
                //dd($u->user_info);
                $u->save();
                
            }
            if (Hash::check($user->email, $condition->user_info)) {
                $u = Agreement::find($condition->id);
                $u->_token = $token;
                //dd($token);
                $u->save();
            }
        }catch(Exception $e)
        {
            return $e;
        }
    }

    public function payouts()
    {
        try {
        }catch(Exception $e)
        {

        }
    }

}