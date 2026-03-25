<?php
// Run from D:\xampp\htdocs\GFE\
// Fix 1: Add service-detail route to routes/front.php

$routeFile = 'routes/front.php';
$content   = file_get_contents($routeFile);

if (strpos($content, 'service-detail') !== false) {
    echo "✅ service-detail route already exists" . PHP_EOL;
} else {
    // Append before last closing
    $insert = "\n// ── Service detail page ──────────────────────────────────\n" .
              "Route::get('/service-detail/{slug}', \\App\\Livewire\\Front\\ServiceDetail::class)\n" .
              "    ->name('service-detail');\n";

    // Try to add after product-detail route
    if (preg_match("/Route::get\(['\"]\/product-detail[^;]+;/", $content, $m)) {
        $content = str_replace($m[0], $m[0] . "\n" . $insert, $content);
    } else {
        $content .= $insert;
    }

    file_put_contents($routeFile, $content);
    echo "✅ service-detail route added to front.php" . PHP_EOL;
}

echo PHP_EOL . "Run: php artisan route:clear && php artisan cache:clear" . PHP_EOL;