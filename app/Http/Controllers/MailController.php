<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OtpEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    function sendEmail()
    {

        $to = "rahul@impexperts.com";
        $msg = "OTP B2B account gfebusiness ---";
        $subsect = "OTP Email";
        $otp = "852963";
        try {
            // Attempt to send the email
            Mail::to($to)->send(new OtpEmail($msg, $subsect, $otp));

            // Log success message
            Log::info('Email sent successfully to ' . $to);
        } catch (\Exception $e) {
            // Log the error message if sending fails
            Log::error('Error sending email: ' . $e->getMessage());

            // Optionally, display or return the error message
            echo 'Error: ' . $e->getMessage();
        }
    }
}
