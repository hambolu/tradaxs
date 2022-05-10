<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
       
            return view('profile');
    }
    
    public function merchantRequest(Request $request)
    {
       
            if(Auth::user()->username == null){
                return back()->with('error', 'Username can not be left Empty');
            }elseif(Auth::user()->name == null){
                return back()->with('error', 'Full Name can not be left Empty');
            }elseif(Auth::user()->phone == null){
                return back()->with('error', 'Phone Number can not be left Empty');
            }elseif(Auth::user()->address == null){
                return back()->with('error', 'Address can not be left Empty');
            
            }elseif(Auth::user()->bvn == null){
                return back()->with('error', 'BVN can not be left Empty');
                
            }else{
                $merchant_request = User::find(Auth::user()->id);
                $merchant_request->m_request = 1;
                $merchant_request->save();
                
                return back()->with('success', 'Request Successful Await Admin Confirmation.');
            }
    }
    
    public function allMerchanta()
    {
       
            $mec = User::all();
            return view('admin.all-agents',compact('mec'));
    }
    
     public function mapprove(Request $request, $id)
    {
       
        $mec = User::find($id);
        $mec->m_request = 2;
        $mec->role = 2;
        $mec->save();  

        return back()->with('success', 'Confirmed');
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
        if($request->has('username')){
            $username = $request->username;
            

            $getUser = User::where('id', Auth::user()->id)->first();

            $getUser->update([
                'username' => $username
            ]);

            $data = $getUser->username;
            echo $data;
        };

        if($request->has('email')){
            $email = $request->email;
            

            $getUser = User::where('id', Auth::user()->id)->first();

            $getUser->update([
                'email' => $email
            ]);

            $data = $getUser->email;
            echo $data;
        };

       

        if($request->has('name')){
            $name = $request->name;
            

            $getUser = User::where('id', Auth::user()->id)->first();

            $getUser->update([
                'name' => $name
            ]);

            $data = $getUser->name;
            echo $data;
        };

        if($request->has('phone')){
            $phone = $request->phone;
            

            $getUser = User::where('id', Auth::user()->id)->first();

            $getUser->update([
                'phone' => $phone
            ]);

            $data = $getUser->phone;
            echo $data;
        };

        if($request->has('address')){
            $address = $request->address;
            

            $getUser = User::where('id', Auth::user()->id)->first();

            $getUser->update([
                'address' => $address
            ]);

            $data = $getUser->address;
            echo $data;
        };

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user_profile')->with('user', $user);
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
        $data = $request->username;
        echo $data;
        /* $username = $request->username();
        $user = User::find($id);

        $data = $user->update([
            'username' => $username,
        ]);

        return $data; */

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


    public function imageUploadPost(ImageRequest $request, $id)

    {
        $imageName = 'Tradaxs' . time() . '.' . $request->profile_pics->extension();
        $request->profile_pics->move(public_path('profile_images'), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        $user = User::find($id);
        $user->update([
            'image' => $imageName,
        ]);


        //return back()
        return redirect()->route('profile.index')

            ->with('success', 'You have successfully upload image.')

            ->with('image', $imageName);
    }
}
