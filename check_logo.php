<?php

// Run this from D:\xampp\htdocs\GFE\
// It checks storage link and logo path

echo "=== Storage Link Check ===" . PHP_EOL;
$publicStorage = 'public/storage';
if (is_link($publicStorage)) {
    echo "✅ Storage link EXISTS: public/storage -> " . readlink($publicStorage) . PHP_EOL;
} else {
    echo "❌ Storage link MISSING — run: php artisan storage:link" . PHP_EOL;
}

echo PHP_EOL . "=== Logo File Check ===" . PHP_EOL;

// Check if actual file exists
$logoPath = 'storage/app/public/seller-assets';
if (is_dir($logoPath)) {
    $dirs = glob($logoPath . '/*', GLOB_ONLYDIR);
    foreach ($dirs as $dir) {
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            echo "Found: " . $file . PHP_EOL;
            $relativePath = str_replace('storage/app/public/', '', $file);
            echo "URL would be: " . 'http://127.0.0.1:8000/storage/' . $relativePath . PHP_EOL;
        }
    }
} else {
    echo "No seller-assets folder found in storage/app/public/" . PHP_EOL;
}

echo PHP_EOL . "=== DB Check ===" . PHP_EOL;
// Check what's stored in DB
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$details = \Illuminate\Support\Facades\DB::connection('globpulse')
    ->table('seller_details')
    ->whereNotNull('logo_url')
    ->select('seller_id', 'logo_url')
    ->get();

foreach ($details as $d) {
    echo "seller_id: " . $d->seller_id . PHP_EOL;
    echo "logo_url in DB: " . $d->logo_url . PHP_EOL;
    
    // Check if file actually exists at this path
    $fullPath = 'storage/app/public/' . $d->logo_url;
    echo "File exists at storage/app/public/{$d->logo_url}: " . (file_exists($fullPath) ? "✅ YES" : "❌ NO") . PHP_EOL;
    echo "Public URL: http://127.0.0.1:8000/storage/" . $d->logo_url . PHP_EOL;
    echo PHP_EOL;
}
