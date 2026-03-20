<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerDocument extends Model
{
    protected $table        = 'seller_documents';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = false;

    // This table uses 'uploaded_at' not created_at/updated_at
    const CREATED_AT = 'uploaded_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'id', 'seller_id', 'document_type', 'file_name',
        'file_size_bytes', 'mime_type', 'storage_url', 'checksum',
        'review_status', 'reviewed_by', 'rejection_reason',
        'is_latest', 'reviewed_at', 'uploaded_at',
    ];

    protected $casts = [
        'is_latest'   => 'boolean',
        'uploaded_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    // Scope: only latest documents
    public function scopeLatest($query)
    {
        return $query->where('is_latest', 1);
    }

    // Scope: only pending review
    public function scopePending($query)
    {
        return $query->where('review_status', 'pending');
    }
}

?>