<?php

$file = 'app/Livewire/Seller/Profile.php';
$content = file_get_contents($file);

// Replace render() with correct version passing all variables blade needs
$fixed = preg_replace(
    '/public function render\(\)\s*\{.*?\}/s',
    'public function render()
    {
        $seller = \App\Models\Seller::with(\'details\',\'documents\',\'activeSubscription\')
            ->find(\Illuminate\Support\Facades\Session::get(\'seller_id\'));

        return view(\'livewire.seller.profile\', [
            \'seller\'             => $seller,
            \'customer\'           => $seller,           // blade alias
            \'countries\'          => collect($this->countries ?? []),
            \'documents\'          => $this->documents   ?? collect(),
            \'completion\'         => $this->completion,
            \'profilePercentage\'  => $this->completion, // blade uses this name
            \'stepScore\'          => $this->stepScore,
            \'currentPlan\'        => $this->currentPlan ?? null,
            \'successMsg\'         => $this->successMsg  ?? \'\',
            \'errorMsg\'           => $this->errorMsg    ?? \'\',
            \'docVerification\'    => $this->docVerification ?? [],
        ]);
    }',
    $content
);

file_put_contents($file, $fixed);
echo "Fixed: " . $file . PHP_EOL;
echo "Now run: php artisan view:clear" . PHP_EOL;
