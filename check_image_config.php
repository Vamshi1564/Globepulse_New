<?php
// Run from D:\xampp\htdocs\GFE\
// Fix 1: Add GFE_URL and image URL helper to config
// Fix 2: Check pub_aws_url is set

echo "=== Checking .env ===" . PHP_EOL;
$env = file_get_contents('.env');

if (strpos($env, 'PUB_AWS_URL') === false && strpos($env, 'pub_aws_url') === false) {
    echo "⚠️  PUB_AWS_URL not in .env — images using local storage" . PHP_EOL;
    echo "Add this to .env for local development:" . PHP_EOL;
    echo "PUB_AWS_URL=" . PHP_EOL;
    echo "(Leave empty for local, set to S3 URL for production)" . PHP_EOL;
} else {
    echo "✅ PUB_AWS_URL found in .env" . PHP_EOL;
}

echo PHP_EOL . "=== Checking config/app.php ===" . PHP_EOL;
$appConfig = file_get_contents('config/app.php');
if (strpos($appConfig, 'pub_aws_url') === false) {
    echo "⚠️  pub_aws_url not in config/app.php" . PHP_EOL;
    echo "Add this inside the return array in config/app.php:" . PHP_EOL;
    echo "  'pub_aws_url' => env('PUB_AWS_URL', '')," . PHP_EOL;
    echo "  'gfe_url'     => env('GFE_URL', 'http://127.0.0.1:8000')," . PHP_EOL;
} else {
    echo "✅ pub_aws_url found in config/app.php" . PHP_EOL;
}

echo PHP_EOL . "Run: php artisan config:clear && php artisan cache:clear" . PHP_EOL;