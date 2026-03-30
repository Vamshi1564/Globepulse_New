<?php
// routes/front.php
use App\Http\Controllers\DocDownloadController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SwitchUserContriller;
use App\Livewire\About;
use App\Livewire\Awards;
use App\Livewire\B2bmarketplace;
use App\Livewire\Byleads;
use App\Livewire\Career;
use App\Livewire\Cha;
use App\Livewire\Contact;
use App\Livewire\DomesticInternationalTradeTours;
use App\Livewire\Ebo;
use App\Livewire\ECommerce;
use App\Livewire\EximBusinessSetup;
use App\Livewire\EximTraining;
use App\Livewire\Front\BlogPage;
use App\Livewire\Front\CompanyInformationForm;
use App\Livewire\Front\CompanyRegistration;
use App\Livewire\Front\Hotdeal;
use App\Livewire\Front\Home as FrontHome;
use App\Livewire\Front\Portfolio;
use App\Livewire\Front\Product;
use App\Livewire\Front\ProductDetail;
use App\Livewire\Front\ServiceDetail;
use App\Livewire\Front\ProductInquiry;
use App\Livewire\Front\RfqComponent;
use App\Livewire\Front\Signup;
use App\Livewire\Front\TermsConditions;
use App\Livewire\Postbyrequirement;
use App\Livewire\TextEditor;
use App\Livewire\EmailVerify;
use App\Livewire\Front\BlogDetail;
use App\Livewire\Front\BuyleadInquiry;
use App\Livewire\Gsp;
use App\Livewire\Packages;
use App\Livewire\Packages1;
use App\Livewire\ProductsCategory;
use App\Livewire\TradeFinanceSolutions;
use Illuminate\Support\Facades\Route;
use App\Livewire\Front\BuyerLogin;
use App\Livewire\Front\BuyerSignup;
use App\Livewire\Front\SellerLogin;
use App\Livewire\Front\SellerSignup;

use App\Livewire\Front\BuyerProfile;
use App\Livewire\Front\BuyerDashboard;
use App\Livewire\Front\MyRFQs;
use App\Livewire\Front\ViewRFQ;
use App\Livewire\Front\Quotations;
use App\Http\Controllers\QuotationController;
use App\Livewire\Front\BuyerInfo;  // ✅ updated namespace


// public website / front routes (preserved exactly)

// service & homepage
Route::get('/about', About::class)->name('about');
Route::get('/Exim_training', EximTraining::class)->name('Exim_training');
Route::get('/Exim-business-setup', EximBusinessSetup::class)->name('Exim-business-setup');
Route::get('/gsp', Gsp::class)->name('gsp');
Route::get('/e-commerce', ECommerce::class)->name('e-commerce');
Route::get('/ebo', Ebo::class)->name('ebo');
Route::get('/cha', Cha::class)->name('cha');
Route::get('/domestic-international-trade-tours', DomesticInternationalTradeTours::class)->name('domestic-international-trade-tours');
Route::get('/', FrontHome::class)->name('home');
Route::get('/about', About::class)->name('about');

Route::get('/contact', Contact::class)->name('contact');
Route::get('/career', Career::class)->name('career');
Route::get('/awards', Awards::class)->name('awards');

// front product & pages
Route::get('/products', Product::class)->name('product');
Route::get('/product-inquiry/{customer_id}/{product_id}', ProductInquiry::class)->name('product-inquiry');
Route::get('/buylead-inquiry/{customer_id}/{postbyrequirement_id}', BuyleadInquiry::class)->name('buylead-inquiry');
Route::get('/rfq/{product_id}/{supplier_id}', function ($product_id, $supplier_id) {
    return view('rfq-page', compact('product_id', 'supplier_id'));
})->name('rfq.create');
Route::get('/product-detail/{slug}', ProductDetail::class)->name('product-detail');

Route::get('/service-detail/{slug}', ServiceDetail::class)
    ->name('service-detail');
Route::get('/signup/{id?}', Signup::class)->name('signup');
Route::get('/buyer/login', BuyerLogin::class)->name('buyer.login');
Route::get('/buyer/signup', BuyerSignup::class)->name('buyer.signup');

Route::get('/seller/login', SellerLogin::class)->name('seller.login');
Route::get('/seller/set-first-password', \App\Livewire\Front\SellerSetFirstPassword::class)->name('seller.set-first-password');
Route::get('/seller/signup', SellerSignup::class)->name('seller.signup');
// Route::get('/profile', Profile::class)->name('profile');
Route::get('/buyer/profile', BuyerProfile::class)->name('buyer.profile');


Route::get('/seller/profile', \App\Livewire\Seller\Profile::class)->name('seller.profile');
// Landing page
Route::get('/start-selling', \App\Livewire\Front\Sellerl::class)->name('start-selling');

// Register form (shown when "Start Selling" button clicked)
Route::get('/seller/register', \App\Livewire\Front\SellerSignup::class)->name('seller.register');

// OTP page — add a blank one for now so no error
Route::get('/seller/verify-email', \App\Livewire\Front\SellerVerifyOtp::class)
    ->name('seller.verify.otp');

// Seller login — blank for now
// Route::get('/seller/login', \App\Livewire\Front\SellerLogin::class)
//     ->name('seller.login');


Route::get('/seller/set-password', \App\Livewire\Front\SellerSetPassword::class)
    ->name('seller.set-password');

Route::get('/seller/forgot-password', \App\Livewire\Front\SellerForgotPassword::class)
    ->name('seller.forgot-password');



// ── Seller Logout ─────────────────────────────────────────────
Route::get('/seller/logout', function () {
    session()->forget(['seller_id', 'seller_email', 'seller_name']);
    return redirect()->route('seller.login')
        ->with('login_success', 'You have been logged out successfully.');
})->name('seller.logout');

// ── Seller Dashboard (placeholder until built) ────────────────
// Route::get('/seller/dashboard', function () {
//     if (!session('seller_id')) {
//         return redirect()->route('seller.login');
//     }
//     return 'Dashboard coming soon — logged in as: ' . session('seller_email');
// })->name('seller.dashboard');



// ── Buyer Landing Page ─────────────────────────────
// Route::get('/start-buying', \App\Livewire\Front\BuyerLanding::class)
//     ->name('start-buying');


// ── Buyer Register ─────────────────────────────────
Route::get('/buyer/register', \App\Livewire\Front\BuyerSignup::class)
    ->name('buyer.register');


// ── Buyer Email OTP Verification ───────────────────
Route::get('/buyer/verify-email', \App\Livewire\Front\BuyerVerifyOtp::class)
    ->name('buyer.verify.otp');


// ── Buyer Login ────────────────────────────────────
// Route::get('/buyer/login', \App\Livewire\Front\BuyerLogin::class)
//     ->name('buyer.login');


// ── Buyer Set Password ─────────────────────────────
Route::get('/buyer/set-password', \App\Livewire\Front\BuyerSetPassword::class)
    ->name('buyer.set-password');


// ── Buyer Forgot Password ──────────────────────────
Route::get('/buyer/forgot-password', \App\Livewire\Front\BuyerForgotPassword::class)
    ->name('buyer.forgot-password');


// ── Buyer Logout ───────────────────────────────────
Route::get('/buyer/logout', function () {

    session()->forget([
        'buyer_id',
        'buyer_email',
        'buyer_name'
    ]);

    return redirect()->route('buyer.login')
        ->with('login_success', 'You have been logged out successfully.');

})->name('buyer.logout');
Route::get('/buyer/dashboard', BuyerDashboard::class)->name('buyer.dashboard');
Route::get('/profile', function () {

    if (session()->has('buyer_id')) {
        return redirect('/buyer/profile');
    }

    if (session()->has('seller_id')) {
        return redirect('/seller/profile');
    }

    return redirect('/');

})->name('profile');

Route::get('/buyer/rfqs', MyRFQs::class)
    ->name('buyer.myrfqs');
    Route::get('/buyer/rfq/{id}', ViewRFQ::class)
    ->name('buyer.rfq.view');
Route::get('/buyer/quotations', Quotations::class)
    ->name('buyer.quotations');



Route::post('/quotation/accept/{id}', [QuotationController::class, 'accept'])
    ->name('quotation.accept');

Route::post('/quotation/reject/{id}', [QuotationController::class, 'reject'])
    ->name('quotation.reject');
// ── Buyer Dashboard (temporary placeholder) ────────
// Route::get('/buyer/dashboard', function () {

//     if (!session('buyer_id')) {
//         return redirect()->route('buyer.login');
//     }

//     return 'Buyer Dashboard coming soon — logged in as: ' . session('buyer_email');

// })->name('buyer.dashboard');
// Route::get('/start-selling', \App\Livewire\Front\Sellerl::class)->name('start-selling');
// Route::post('/seller/login', [SellerLoginController::class, 'login'])->name('seller.login.post');

Route::get('/packages', Packages::class)->name('packages');
Route::get('/packages1', Packages1::class)->name('Packages1');
Route::get('/postbyrequirement', Postbyrequirement::class)->name(name: 'postbyrequirement');
Route::get('/byleads', Byleads::class)->name(name: 'byleads');
// Route::get('/suppliers', Suppliers::class)->name(name: 'suppliers');
Route::get('/trade-finance-solutions', TradeFinanceSolutions::class)->name(name: 'trade-finance-solutions');
Route::get('/products-category/{categorySlug?}/{subcategorySlug?}/{subSubcategorySlug?}', ProductsCategory::class)->name('products-category');
Route::get('/portfolio/{customer_id}', Portfolio::class)->name(name: 'portfolio');
Route::get('/term-conditions', TermsConditions::class)->name(name: 'term-conditions');
Route::get('/company-information', CompanyInformationForm::class)->name(name: 'company-information');
Route::get('/hotdeal', Hotdeal::class)->name('hotdeal');
Route::get('/b2b-marketplace-blog', BlogPage::class)->name('blogpage');
Route::get('/blog/category/{category}', BlogPage::class)->name('blog.category');
Route::get('/blog/category/{category}/page/{page}', BlogPage::class)->name('blog.category.page');
Route::get('/blog/author/{name}', BlogPage::class)->name('blog.author');
Route::get('/blog/author/{name}/page/{page}', BlogPage::class)->name('blog.author.page');

Route::get('/blog/{slug}', BlogDetail::class)->name('blog-detile');

Route::get('/company-registration', CompanyRegistration::class)->name('company-registration');

Route::get('/email-verify', EmailVerify::class)->name('emailverify');
Route::get('/b2bmarketplace', B2bmarketplace::class)->name('b2bmarketplace');

Route::get('/text-editor/{id?}', TextEditor::class)->name(name: 'text-editor');

// Email / downloads / misc (preserve exact routes)
Route::get('/send', [MailController::class, 'sendEmail']);
Route::view('/offer-latter', 'email.welcome-mail');
Route::view('/ticket-remark-added', 'email.ticket-remark-added');
Route::view('/exposure-trade-invitation-card', 'email.exposure-trade-invitation-card');
Route::get('/download/{file}', [DocDownloadController::class, 'download'])->name('document.download');

Route::get('/product-not-found', function () {
    return view('product-not-found');
})->name('product.notfound');

// payment
Route::post('/store-payment', [PaymentController::class, 'storePayment'])->name('store.payment');


Route::get('/buyer_info/{id}', BuyerInfo::class)->name('buyer.info');

