<?php
// Run from D:\xampp\htdocs\GFE\
// Resolves merge conflicts in routes/seller.php and routes/front.php
// Keeps YOUR code + adds THEIR new Quotation routes

// ── Fix routes/seller.php ─────────────────────────────────
$file = 'routes/seller.php';
$content = file_get_contents($file);

// Fix conflict 1: import line
$content = str_replace(
    "use App\Livewire\Seller\RFQList;\n<<<<<<< HEAD\n\n=======\nuse App\Livewire\Seller\Quotations as SellerQuotations;\n>>>>>>> f7d950e39accfee04a1040700c7429e4f7f3ebae",
    "use App\Livewire\Seller\RFQList;\nuse App\Livewire\Seller\Quotations as SellerQuotations;",
    $content
);

// Fix conflict 2: route definition
$content = str_replace(
    "->name('seller.rfq.quote');\n<<<<<<< HEAD\n=======\n    Route::get('/seller/quotations', SellerQuotations::class)\n>>>>>>> f7d950e39accfee04a1040700c7429e4f7f3ebae",
    "->name('seller.rfq.quote');\n    Route::get('/seller/quotations', SellerQuotations::class)\n        ->name('seller.quotations');",
    $content
);

// Remove any remaining conflict markers
$content = preg_replace('/<<<<<<< HEAD.*?>>>>>>>[a-f0-9]+\n/s', '', $content);

file_put_contents($file, $content);
echo "Fixed: routes/seller.php" . PHP_EOL;

// ── Fix routes/front.php ──────────────────────────────────
$file2 = 'routes/front.php';
$content2 = file_get_contents($file2);

// Fix conflict 1: import line
$content2 = str_replace(
    "use App\Livewire\Front\ViewRFQ;\n<<<<<<< HEAD\n=======\nuse App\Livewire\Front\Quotations;\n>>>>>>> f7d950e39accfee04a1040700c7429e4f7f3ebae",
    "use App\Livewire\Front\ViewRFQ;\nuse App\Livewire\Front\Quotations;",
    $content2
);

// Fix conflict 2: route definition
$content2 = str_replace(
    "->name('buyer.rfq.view');\n<<<<<<< HEAD\n=======\n   Route::get('/buyer/quotations', Quotations::class)\n    ->name('buyer.quotations');\n>>>>>>> f7d950e39accfee04a1040700c7429e4f7f3ebae",
    "->name('buyer.rfq.view');\n    Route::get('/buyer/quotations', Quotations::class)\n        ->name('buyer.quotations');",
    $content2
);

// Remove any remaining conflict markers
$content2 = preg_replace('/<<<<<<< HEAD.*?>>>>>>>[a-f0-9]+\n/s', '', $content2);

file_put_contents($file2, $content2);
echo "Fixed: routes/front.php" . PHP_EOL;

echo PHP_EOL . "Done! Now run:" . PHP_EOL;
echo "git add routes/seller.php routes/front.php" . PHP_EOL;
