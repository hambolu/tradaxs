<?php

namespace App\Http\Controllers\Apis\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerification extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;

    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                "status" => $this->successStatus,
                'message' => 'Already Verified'
            ];
        }

        $request->user()->sendEmailVerificationNotification();

        return ["status" => $this->successStatus, 'status' => 'verification-link-sent'];
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                "status" => $this->successStatus,
                'message' => 'Email already verified'
            ];
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return [
            "status" => $this->successStatus,
            'message'=>'Email has been verified'
        ];
    }
}
