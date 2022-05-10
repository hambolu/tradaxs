<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\TwiML\Voice\Pay;

class TrainingController extends Controller
{
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
        $trainings = Training::all();
        
            return view('training', compact('trainings');
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training = Training::find($id);
        $agent = new \Jenssegers\Agent\Agent;
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        if ($desktop) {
            return view('wallet.desktop.course', compact('training'));
        }
        if ($mobile) {
            return view('wallet.mobile.course', compact('training'));
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

    public function coursePlatform($id)
    {
        $agent = new \Jenssegers\Agent\Agent;
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        if ($desktop) {
            return view('wallet.desktop.course_platform');
        }
        if ($mobile) {
            return view('wallet.mobile.course_platform');
        }
    }
}
