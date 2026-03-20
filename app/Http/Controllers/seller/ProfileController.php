<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function profile()
    {

        $seller = auth()->user();

        $profilePercentage = 0;
        $missingDetails = [];

        /* MOBILE VERIFICATION */

        if($seller->mobile_verified){
            $profilePercentage += 15;
        }else{
            $missingDetails[] = [
                'label' => 'Verify mobile number',
                'percent' => 15
            ];
        }

        /* EMAIL VERIFICATION */

        if($seller->email_verified){
            $profilePercentage += 15;
        }else{
            $missingDetails[] = [
                'label' => 'Verify email address',
                'percent' => 15
            ];
        }

        /* PROFILE PHOTO */

        if($seller->profile_image){
            $profilePercentage += 10;
        }else{
            $missingDetails[] = [
                'label' => 'Upload profile photo',
                'percent' => 10
            ];
        }

        /* GST */

        if($seller->gst_no){
            $profilePercentage += 15;
        }else{
            $missingDetails[] = [
                'label' => 'Add GST number',
                'percent' => 15
            ];
        }

        /* COMPANY */

        if($seller->company){
            $profilePercentage += 15;
        }else{
            $missingDetails[] = [
                'label' => 'Add company details',
                'percent' => 15
            ];
        }

        /* DOCUMENT */

        if($seller->document){
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