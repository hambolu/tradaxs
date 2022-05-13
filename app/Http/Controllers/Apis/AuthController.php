<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\WalletCollection;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;


    public function Login(Request $request)
    {
        try {
            //Login to account
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

                //$user = User::where('id',Auth::id())->get();
                $user = UserCollection::collection(User::with('account')->where('id',Auth::id())->get());
                if(Auth::user()->email_verified_at == null){
                    return response()->json(
                        ["status" => $this->failedStatus,
                        'error' => 'Unverified',
                        'verification_link' => '/email/verify'], 401);
                }else{

                    $user_wallets = WalletCollection::collection(Wallet::where('user_id',Auth::id())->get());
                return response()->json(["status" => $this->successStatus, "user"=>[$user,$user_wallets]])
        ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
                }
            }else{
                return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'            => 'required|max:255',
            'email'           => 'required|max:255|unique:users',
            'phone'           => 'required',
            'bvn'       => 'required',
            'username'          => 'required',
            'password'        => 'required|min:8',
        ]);
        try {


            if(User::where('username',$request->input('username'))->exists()  || $request->input('username') == null){
                return response()->json(["status" => $this->failedStatus,'error' => 'UserName exits or  empty'], 401);
            }else
            if(User::where('phone',$request->input('phone'))->exists()  || $request->input('phone') == null){
                return response()->json(["status" => $this->failedStatus,'error' => 'Phone exits or  empty'], 401);
            }else
            if(User::where('bvn',$request->input('bvn'))->exists() || $request->input('bvn') == null){
                return response()->json(["status" => $this->failedStatus,'error' => 'Bvn Exists or  empty'], 401);
            }else
            if(User::where('name',$request->input('name'))->exists() || $request->input('name') == null){
                return response()->json(["status" => $this->failedStatus,'error' => 'Name Exists or  empty'], 401);
            }else
            if(User::where('email',$request->input('email'))->exists() || $request->input('email') == null){
                return response()->json(["status" => $this->failedStatus,'error' => 'Email Exists or  empty'], 401);
            }else{
                $create = new User();
                $create->name = $request->input('name');
                $create->email = $request->input('email');
                $password = $request->input('password');
                $create->password = Hash::make($password);
                $create->phone = $request->input('phone');
                $create->username = $request->input('username');
                $create->bvn = $request->input('bvn');



                    dd($create);
                $create->save();
                return response()->json(["status" => $this->successStatus, "user"=> $create])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
                }

        } catch (Exception $e) {
            //throw $th;
        }
    }
}
