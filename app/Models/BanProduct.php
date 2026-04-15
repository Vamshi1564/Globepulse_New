<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BanProduct extends Model
{
    protected $table = 'ban_products';

    protected $fillable = [
        'product_title',
        'category_id',
        'ban_type',
        'banned_countries',
        'ban_reason',
        'country_of_origin',
        'keywords',
        'banned_at'
    ];

    protected $casts = [
        'banned_countries' => 'array',
        'banned_at' => 'datetime'
    ];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
    public function updatedTitle($value)
{
    $this->banError = '';

    $title = strtolower($value);

    $bans = BanProduct::all();

    foreach ($bans as $ban) {

        // Check product title match
        if (!empty($ban->product_title) && str_contains($title, strtolower($ban->product_title))) {
            $this->banError = '🚫 This product has been banned. Please add another product.';
            return;
        }

        // Check keywords
        if (!empty($ban->keywords)) {
            $keywords = explode(',', strtolower($ban->keywords));

            foreach ($keywords as $word) {
                if ($word && str_contains($title, trim($word))) {
                    $this->banError = '🚫 This product has been banned. Please add another product.';
                    return;
                }
            }
        }
    }
}
}