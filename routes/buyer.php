<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Front\BuyerDashboard;
use App\Http\Middleware\BuyerAuth;

Route::middleware([BuyerAuth::class])->group(function(){

    Route::get('/buyer/dashboard', BuyerDashboard::class)
        ->name('buyer.dashboard');

});