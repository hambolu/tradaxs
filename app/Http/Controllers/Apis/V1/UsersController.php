<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Traits\CryptoBalance;
use App\Http\Traits\Accounts;
use Uuid;
use App\Http\Resources\UserCollection;
use App\Http\Resources\WalletCollection;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;


class UsersController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;
    use CryptoBalance;
    use Accounts;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = request('userId');
        try{
            $accounts = $this->createAccount($user_id);
        $user_wallets = WalletCollection::collection(Wallet::where('user_id',$user_id)->get());
        $user = UserCollection::collection(User::with('account')->where('id',$user_id)->get());

        $cryptobalance = $this->balance($user_id);

        return response()->json(["status" => $this->successStatus, "user"=> $user, 'user_wallet' => $user_wallets])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        } catch (Exception $e) {
            return $e;
        }

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
        $uuid = Uuid::generate()->string;
                //dd($uuid);
        try {
        $request->validate([
            'name'            => 'required|max:255',
            'email'           => 'required|max:255|unique:users',
            'phone'           => 'required',
            'bvn'       => 'required',
            'username'          => 'required',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'bvn'   => $request->bvn,
            'unique_id' => $uuid,
            'phone'  => $request->phone,
            'username'  => $request->username,
            'password' => Hash::make($request->password),
        ]);
                // $create = new User();
                // $create->unique_id = $uuid;
                // $create->name = $request->input('name');
                // $create->email = $request->input('email');
                // $password = $request->input('password');
                // $create->password = Hash::make($password);
                // $create->phone = $request->input('phone');
                // $create->username = $request->input('username');
                // $create->bvn = $request->input('bvn');
                //     //dd($create);
                // $create->save();
                event(new Registered($user));
                return response()->json(["status" => $this->successStatus, "user"=> $user])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);

        } catch (Exception $e) {
            return response($e);

        }

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
        try {
            $user = User::find($id);
            return response()->json(["status" => $this->successStatus, "user"=> $user])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        } catch (Exception $e) {
            //throw $th;
        }
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
        $user = User::find($id);
        try {
            $request->validate([
                'name'            => 'required|max:255',
                'email'           => 'required|max:255|unique:users',
                'phone'           => 'required',
                'bvn'       => 'required',
                'username'          => 'required',
                'password'        => 'required|min:8',
            ]);

                    $update = new User();
                    $update->name = $request->input('name');
                    $update->email = $request->input('email');
                    $password = $request->input('password');
                    $update->password = Hash::make($password);
                    $update->phone = $request->input('phone');
                    $update->username = $request->input('username');
                    $update->bvn = $request->input('bvn');



                        //dd($update);
                    $update->save();
                    return response()->json(["status" => $this->successStatus, "user"=> $update])
                ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
            } catch (Exception $e) {
                return $e;
            }
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
