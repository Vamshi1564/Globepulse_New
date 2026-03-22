<?php

$file = 'app/Models/Product.php';
$content = file_get_contents($file);

// Add brand_name to fillable
$content = str_replace(
    "        // ── GlobPulse seller fields ──\n        'seller_id',\n        'rejection_reason',",
    "        // ── GlobPulse seller fields ──\n        'seller_id',\n        'rejection_reason',\n        'brand_name',",
    $content
);

file_put_contents($file, $content);
echo "Fixed: brand_name added to Product fillable" . PHP_EOL;
echo PHP_EOL . "Now run this SQL to fix AUTO_INCREMENT:" . PHP_EOL;
echo "ALTER TABLE tbl_products MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;" . PHP_EOL;