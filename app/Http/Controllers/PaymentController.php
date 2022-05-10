<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        //Getting authenticated user
        $id = Auth::user()->id;
        // Getting the specific student and his details
        $student = Student::where('user_id', $id)->first();
        /* $class_id = $student->class_id;
        $section_id = $student->section_id;
        $level_id = $student->level_id; */
        $student_id = $student->id;

        $paymentDetails = Paystack::getPaymentData(); //this comes with all the data needed to process the transaction
        // Getting the value via an array method
        $inv_id = $paymentDetails['data']['metadata']['invoiceId']; // Getting InvoiceId I passed from the form
        $status = $paymentDetails['data']['status']; // Getting the status of the transaction
        $amount = $paymentDetails['data']['amount']; //Getting the Amount
        $number = $randnum = rand(1111111111, 9999999999); // this one is specific to application
        $number = 'year' . $number;
        // dd($status);
        if ($status == "success") { //Checking to Ensure the transaction was succesful

            Payment::create(['student_id' => $student_id, 'invoice_id' => $inv_id, 'amount' => $amount, 'status' => 1]); // Storing the payment in the database
            return redirect()->route('course_platform');
        }

        // Now you have the payment details,
        // you can store the authorization_code in your DB to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
