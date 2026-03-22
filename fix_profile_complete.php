<?php

$file = 'app/Livewire/Seller/Profile.php';
$content = file_get_contents($file);

// Replace render() with complete version passing ALL variables the blade uses
$fixed = preg_replace(
    '/public function render\(\)\s*\{.*?\}/s',
    'public function render()
    {
        $sellerId = \Illuminate\Support\Facades\Session::get(\'seller_id\');
        $seller   = \App\Models\Seller::with(\'details\', \'documents\', \'activeSubscription\')
                        ->find($sellerId);

        // Build missingDetails — list of fields the seller has not filled yet
        $missingDetails = [];
        if (empty($this->phone))               $missingDetails[] = \'Phone number\';
        if (empty($this->country_id))          $missingDetails[] = \'Country\';
        if (empty($this->legal_business_name)) $missingDetails[] = \'Business name\';
        if (empty($this->business_type))       $missingDetails[] = \'Business type\';
        if (empty($this->business_address))    $missingDetails[] = \'Business address\';
        if (empty($this->city))                $missingDetails[] = \'City\';
        if (empty($this->num_employees))       $missingDetails[] = \'Number of employees\';
        if (empty($this->company_description)) $missingDetails[] = \'Company description\';
        if (empty($this->main_products))       $missingDetails[] = \'Main products\';

        return view(\'livewire.seller.profile\', [
            // Core seller objects
            \'seller\'            => $seller,
            \'customer\'          => $seller,           // blade uses $customer as alias

            // Collections
            \'countries\'         => collect($this->countries      ?? []),
            \'documents\'         => $this->documents              ?? collect(),
            \'docVerification\'   => $this->docVerification        ?? [],

            // Computed
            \'completion\'        => $this->completion,
            \'profilePercentage\' => $this->completion,  // blade uses $profilePercentage
            \'stepScore\'         => $this->stepScore,
            \'missingDetails\'    => $missingDetails,

            // State
            \'currentPlan\'       => $this->currentPlan   ?? null,
            \'successMsg\'        => $this->successMsg    ?? \'\',
            \'errorMsg\'          => $this->errorMsg      ?? \'\',
        ]);
    }',
    $content
);

file_put_contents($file, $fixed);
echo "Fixed: " . $file . PHP_EOL;
echo "Now run: php artisan view:clear && php artisan cache:clear" . PHP_EOL;
