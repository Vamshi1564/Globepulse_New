<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function profile()
    {

        $customer = auth()->user();

        $profilePercentage = 0;
        $missingDetails = [];

        /* MOBILE VERIFICATION */

        if($customer->mobile_verified){
            $profilePercentage += 15;
        }else{
            $missingDetails[] = [
                'label' => 'Verify mobile number',
                'percent' => 15
            ];
        }

        /* EMAIL VERIFICATION */

        if($customer->email_verified){
            $profilePercentage += 15;
        }else{
            $missingDetails[] = [
                'label' => 'Verify email address',
                'percent' => 15
            ];
        }

        /* PROFILE PHOTO */

        if($customer->profile_image){
            $profilePercentage += 10;
        }else{
            $missingDetails[] = [
                'label' => 'Upload profile photo',
                'percent' => 10
            ];
        }

        /* GST */

        if($customer->gst_no){
            $profilePercentage += 15;
        }else{
            $missingDetails[] = [
                'label' => 'Add GST number',
                'percent' => 15
            ];
        }

        /* COMPANY */

        if($customer->company){
            $profilePercentage += 15;
        }else{
            $missingDetails[] = [
                'label' => 'Add company details',
                'percent' => 15
            ];
        }

        /* DOCUMENT */

        if($customer->document){
            $profilePercentage += 30;
        }else{
            $missingDetails[] = [
                'label' => 'Upload business document',
                'percent' => 30
            ];
        }

        return view('seller.profile', compact(
            'customer',
            'profilePercentage',
            'missingDetails'
        ));
    }

}