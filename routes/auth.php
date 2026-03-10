<?php
// routes/auth.php
use App\Livewire\Auth\AdminLogin;
use App\Livewire\Auth\AuthOtp;
use App\Livewire\Auth\AdminAuthotp;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

// authentication & login routes (preserved exactly)
Route::get('/login', Login::class)->name('login');
Route::get('/login/auth-otp', AuthOtp::class)->name('auth-otp');
