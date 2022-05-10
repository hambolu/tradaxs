<?php

namespace App\Http\Controllers;

use App\Models\SmsVerification;
use Exception;
use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SmsController extends Controller
{
    public function index()
    {
        $receiverNumber = "RECEIVER_NUMBER";

        $message = "This is testing from ItSolutionStuff.com";



        try {
            $account_sid = getenv("TWILIO_SID");

            $auth_token = getenv("TWILIO_TOKEN");

            $twilio_number = getenv("TWILIO_FROM");



            $client = new Client($account_sid, $auth_token);

            $client->messages->create($receiverNumber, [

                'from' => $twilio_number,

                'body' => $message
            ]);



            dd('SMS Sent Successfully.');
        } catch (Exception $e) {

            dd("Error: " . $e->getMessage());
        }
    }

}
